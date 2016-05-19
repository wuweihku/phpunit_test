<?php
/**
 *文件	CsvFileIterator.php
 *这个类用于生成迭代器对象，读取csv/**.csv文件的每一行数据
 */
class CsvFileIterator implements Iterator {
    protected $file;
    protected $key = 0;
    protected $current;

    public function __construct($file) {
        $this->file = fopen($file, 'r');
    }

    public function __destruct() {
        fclose($this->file);
    }

    public function rewind() {  //移到首元素
        rewind($this->file);
        $this->current = fgetcsv($this->file);
        $this->key = 0;
    }

    public function valid() {  //判定是否还有后续元素, 如果有, 返回true
        return !feof($this->file);
    }

    public function key() {   //返回当前元素的键值
        return $this->key;
    }

    public function current() {  //返回当前元素值
        return $this->current;
    }

    public function next() {  //下移一个元素
        $this->current = fgetcsv($this->file);
        $this->key++;
    }
}
?>

