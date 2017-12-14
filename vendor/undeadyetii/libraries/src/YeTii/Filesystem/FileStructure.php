<?php
 /**
  * @deprecated
  * @deprecated No longer in use. Highly recommend not using this class
  */

namespace YeTii\FileSystem;

use YeTii\General\Num;
use YeTii\General\Str;

/**
 * Class FileStructure
 */
class FileStructure
{
    /**
     * @var string
     */
    protected $filename; // name of file or folder
    /**
     * @var int|bool
     */
    protected $is_dir; // 1 or 0
    /**
     * @var int|bool
     */
    protected $exists; // 1 or 0
    /**
     * @var string
     */
    protected $parent_path; // path of directory
    /**
     * @var string
     */
    protected $parent_path_real; // path of directory
    /**
     * @var string
     */
    protected $parent_name; // basename of parent_path
    /**
     * @var string
     */
    protected $file_path; // $parent_path/$filename
    /**
     * @var string
     */
    protected $file_path_real; // $parent_path/$filename
    /**
     * @var int
     */
    protected $file_size; // size in bytes
    /**
     * @var int
     */
    protected $date_modified; // date modified of file
    /**
     * @var array
     */
    protected $children; // children as FileStructure object
    /**
     * @var int
     */
    protected $children_count; // count of children
    /**
     * @var $this|null
     */
    protected $base_path; // the path to ignore from prefix


    // ------------------- INTERNAL FUNCTIONS ---------------------

    /**
     * FileStructure constructor.
     * @param string|null  $path
     * @param array $args
     */
    function __construct($path = null, array $args = [])
    {
        $this->settings = (object)[
            'get_children'      => isset($args['get_children']) ? $args['get_children'] : true,
            'get_recursive'     => isset($args['recursive']) ? $args['recursive'] : true,
            'show_hidden_files' => isset($args['show_hidden_files']) ? $args['show_hidden_files'] : true,
        ];
        if ($path) {
            $this->base_path = isset($args['base_path']) ? Str::parseDir($args['base_path']) : null;
            $this->set_file_path($path);
            $this->initialize();
        }
    }

    /**
     * @param $file_path_real
     */
    private function set_file_path($file_path_real)
    {
        if ($this->base_path != null) {
            $this->file_path = Str::replacePrefix($file_path_real, $this->base_path, '');
        } else {
            $this->file_path = $file_path_real;
        }
        printDie($file_path_real, false);
        $this->file_path_real = $file_path_real;
        printDie($this->file_path_real, false);
        $this->filename = Str::afterLast(rtrim($this->file_path, '/'), '/');
        $this->parent_path = Str::beforeLast(rtrim($this->file_path, '/'), '/');
        $this->parent_path_real = Str::beforeLast(Str::parseDir($file_path_real), '/');
        $this->parent_name = Str::afterLast($this->parent_path, '/');
        printDie($this->get());
    }

    /**
     * @return bool
     */
    private function initialize()
    {
        if (!$this->file_path) {
            return false;
        }
        if (file_exists($this->file_path)) {
            $this->exists = 1;
            $this->is_dir = is_dir($this->file_path);
            $this->file_size = $this->filesize($this->file_path);
            $this->date_modified = filemtime($this->file_path);
            $this->children = ($this->settings->get_children || $this->settings->get_recursive) ? $this->children() : null;
        } else {
            $this->exists = 0;
        }
    }

    /**
     * @param $path
     * @return int
     */
    private function filesize($path)
    {
        if (!is_dir($path)) {
            return filesize($path);
        }
        $size = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
            if (file_exists($file->getRealPath()) && $file->isReadable()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }

    /**
     * @param $path
     * @return bool
     */
    private function filedelete($path)
    {
        if (file_exists($path)) {
            if (is_dir($path)) {
                foreach (scandir($path) as $f) {
                    if ($f == '.' || $f == '..' || $f == '.DS_Store') {
                        continue;
                    }
                    $this->filedelete("$path/$f");
                }

                return rmdir($path);
            } else {
                return unlink($path);
            }
        } else {
            return false;
        }
    }

    /**
     * @param $path
     * @param $search
     * @return bool
     */
    private function internalfind($path, $search)
    {
        if (!isset($this->tmp)) {
            $this->tmp = [];
        }
        $path = rtrim($path, '/');
        if (file_exists($path)) {
            if (is_dir($path)) {
                foreach (scandir($path) as $f) {
                    if ($f == '.' || $f == '..' || $f == '.DS_Store') {
                        continue;
                    }
                    $this->internalfind("$path/$f", $search);
                }
            } else {
                $name = Str::afterLast($path, '/');
                foreach ($search as $key => $value) {
                    if ($key == 'regex' && !preg_match($value, $name)) {
                        return false;
                    } elseif ($key == 'text' && !Str::contains($name, $value)) {
                        return false;
                    } elseif ($key == 'date_modified') {
                        if (preg_match('/^(>|<|>=|<=|=<|=>|!=|==|=|!<|!>|)\s*(\d+)$/', $value, $m)) {
                            if (!Num::customEquation(filemtime($path), $m[1] ? $m[1] : '==', $m[2])) {
                                return false;
                            }
                        } else {
                            return null;
                        }
                    } elseif ($key == 'size') {
                        if (preg_match('/^(>|<|>=|<=|=<|=>|!=|==|=|!<|!>|)\s*(\d+)$/', $value, $m)) {
                            if (!Num::customEquation(filesize($path), $m[1] ? $m[1] : '==', $m[2])) {
                                return false;
                            }
                        } else {
                            return null;
                        }
                    }
                }
                $this->tmp[] = new FileStructure($path);

                return true;
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * @param $children
     * @return array|null
     */
    private function get_children($children)
    {
        if (empty($children)) {
            return null;
        }
        $return = [];
        foreach ($children as $child) {
            array_push($return, $child->get());
        }

        return $return;
    }


    // ------------------- PUBLIC FUNCTIONS ---------------------

    /**
     * @param string $path
     */
    public function base_path(string $path)
    {
        $path = trim($path, '/');
    }

    /**
     * @param string $to
     * @return FileStructure
     */
    public function mock_rename(string $to)
    {
        $copy = clone $this;
        $copy->filename = $to;
        $copy->file_path = Str::parseDir($copy->parent_path, $to);

        return $copy;
    }

    /**
     * @param string $to
     * @return bool
     */
    public function rename(string $to)
    {
        if (!$this->exists) {
            return false;
        }
        if (!strlen($to)) {
            return false;
        }
        $new_path = Str::parseDir($this->parent_path, $to);
        if (file_exists($new_path)) {
            return false;
        }
        rename($this->file_path, $new_path);
        $this->filename = $to;
        $this->parent_path = Str::afterLast(rtrim($new_path, '/'), '/');
        $this->file_path = $new_path;
    }

    /**
     * @param $what
     * @return bool
     */
    public function find($what)
    {
        if (is_string($what) && preg_match('/^\/(.+)\/(|[igsm]+)$/', $what)) {
            $this->internalfind($this->file_path, ['regex' => $what]);
        } elseif (is_string($what)) {
            $this->internalfind($this->file_path, ['text' => $what]);
        } elseif (is_array($what)) {
            $this->internalfind($this->file_path, $what);
        } else {
            return false;
        }
        $return = $this->tmp;
        $this->tmp = null;

        return $return;
    }

    /**
     * @return array|null
     */
    public function children()
    {
        if (!$this->is_dir) {
            return null;
        }
        $this->children = [];
        foreach (scandir($this->file_path) as $f) {
            if ($f == '.' || $f == '..' || $f == '.DS_Store') {
                continue;
            } // ignore these
            if (!$this->settings->show_hidden_files && $file[0] == '.') {
                continue;
            }
            $this->children[] = new FileStructure(Str::parseDir($this->file_path, $f), $this->settings->get_recursive);
        }
        $this->children_count = count($this->children);

        return $this->children;
    }

    /**
     * @param int $levels
     * @return null
     */
    public function parent($levels = 1)
    {
        if ($tmp = rtrim($this->parent_path, '/')) {
            printDie("level is $levels", false);
            while ($levels > 1) {
                $tmp = Str::beforeLast($tmp, '/');
                $levels -= 1;
            }
            printDie("level is now $levels", false);
            if (!$tmp) {
                return null;
            }
            $d = (new FileStructure($tmp, false, false));
            printDie($d->get());
        } else {
            return null;
        }
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->filedelete($this->file_path);
    }

    /**
     * @return bool|null
     */
    public function getExt()
    {
        if ($this->is_dir) {
            return false;
        }

        return preg_match('/\.([a-z0-9]+)$/i', $this->filename, $m) ? $m[1] : null;
    }

    /**
     * @param null $match
     * @return bool|string
     */
    public function hasExt($match = null)
    {
        if ($this->is_dir) {
            return false;
        }

        $ext = null;

        return $ext = $this->getExt() ? (is_string($match) ? $ext == $match : (is_array($match) ? in_array($ext,
            $match) : $ext ? true : 'false')) : false;
    }

    /**
     * @return mixed
     */
    public function exists()
    {
        return $this->exists;
    }

    /**
     * @return mixed
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function file_path()
    {
        return $this->file_path;
    }

    /**
     * @return array
     */
    public function breadcrumbs()
    {
        $return = [];
        $base = '';
        foreach (explode('/', trim($this->file_path_real, '/')) as $crumb) {
            if ($this->base_path && Str::contains($this->base_path, Str::parseDir($base, $crumb))) {
                continue;
            }
            $return[] = (object)[
                'filename'       => $crumb,
                'file_path_real' => Str::parseDir(Str::parseDir($this->base_path, $base), $crumb),
                'file_path'      => $this->base_path ? Str::replacePrefix(Str::parseDir($base, $crumb), $this->base_path,
                    '') : Str::parseDir($base, $crumb)
            ];
            $base .= "/$crumb";
        }
        $this->breadcrumbs = $return;

        return $return;
    }


    // ------------------- TO OBJECT ---------------------

    /**
     * @return object
     */
    public function get()
    {
        return (object)[
            'filename'         => $this->filename,
            'is_dir'           => $this->is_dir,
            'exists'           => $this->exists,
            'parent_path'      => $this->parent_path,
            'parent_path_real' => $this->parent_path_real,
            'parent_name'      => $this->parent_name,
            'file_path'        => $this->file_path,
            'file_path_real'   => $this->file_path_real,
            'file_size'        => $this->file_size,
            'date_modified'    => $this->date_modified,
            'children'         => $this->get_children($this->children),
            'children_count'   => $this->children_count,
            'base_path'        => $this->base_path,
        ];
    }
}