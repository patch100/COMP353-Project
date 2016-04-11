
<?php
class ColorEntity
{
    protected $name;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['Color'])) {
            $this->name = $data['Color'];
        }
    }

    public function getName() {
        return $this->name;
    }
}