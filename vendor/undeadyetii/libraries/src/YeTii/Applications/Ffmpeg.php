<?php
 /**
  * @deprecated
  * @deprecated No longer in use. Highly recommend not using this class
  */

namespace YeTii\Applications;

use YeTii\FileSystem\FileStructure;
use YeTii\General\Str;

/**
 * @deprecated 0.2.0 - This class is abandoned
 */
class Ffmpeg
{
    /**
     * @var string
     */
    protected $format = 'mp4';
    /**
     * @var string
     */
    protected $ffmpeg_dir = '/usr/local/bin/ffmpeg';
    /**
     * @var int
     */
    protected $delete_original = 0;

    /**
     * @var string
     */
    protected $input;
    /**
     * @var string
     */
    protected $output;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var array
     */
    private $formats_available = ['mp4', 'mkv', 'avi', 'm4v', 'mpg', 'flv'];

    /**
     * Ffmpeg constructor.
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        if (isset($args['format'])) {
            $this->format($args['format']);
        }
        if (isset($args['ffmpeg_dir'])) {
            $this->format($args['ffmpeg_dir']);
        }
        if (isset($args['delete_original'])) {
            $this->format($args['delete_original']);
        }
    }

    /**
     * @param null $value
     * @return $this|bool
     */
    public function format($value = null)
    {
        if (!in_array($value, $this->formats_available)) {
            $this->error = 'Unknown format: .' . $value;

            return false;
        }
        $this->format = $value;

        return $this;
    }

    /**
     * @param null $value
     * @return $this|bool
     */
    public function ffmpeg_dir($value = null)
    {
        if (!file_exists($value)) {
            $this->error = 'ffmpeg not found in ' . $value;

            return false;
        }
        $this->ffmpeg_dir = $value;

        return $this;
    }

    /**
     * @param null $value
     * @return $this
     */
    public function delete_original($value = null)
    {
        $this->delete_original = $value ? 1 : 0;

        return $this;
    }

    /**
     * @param FileStructure|null $value
     * @return $this|bool
     */
    public function from(FileStructure $value = null)
    {
        if (!$value->exists()) {
            $this->error = 'Input file not found at ' . $value->file_path;

            return false;
        }
        $this->input = $value;

        return $this;
    }

    /**
     * @param FileStructure|null $value
     * @return $this|bool
     */
    public function to(FileStructure $value = null)
    {
        if ($ext = $value->getExt()) {
            if (!in_array($ext, $this->formats_available)) {
                $this->error = "Format .$ext is not supported";

                return false;
            } else {
                $this->format = $ext;
                $value = $value->mock_rename(Str::stripExtension($value->filename()));
            }
        }
        $this->output = $value;

        return $this;
    }

    /**
     * @return bool
     */
    private function ready()
    {
        if ($this->error) {
            return false;
        }
        if (!$this->input->exists()) {
            return false;
        }
        if (file_exists($this->output->file_path() . '.' . $this->format)) {
            $this->error = 'File already exists at ' . $this->output->file_path() . '.' . $this->format;

            return false;
        }

        return true;
    }

    /**
     * @return bool|null
     */
    public function mux()
    {
        if (!$this->ready()) {
            return null;
        }
        $str = exec($this->ffmpeg_dir
                    . ' -i "'
                    . $this->input->file_path()
                    . '" -c copy "'
                    . $this->output->file_path()
                    . '.'
                    . $this->format
                    . '" 2>&1');
        if (preg_match('/video:/', $str) && $this->delete_original) {
            $this->input->delete();
        }

        return preg_match('/video:/', $str) ? true : false;
    }
}