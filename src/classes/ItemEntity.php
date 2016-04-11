<?php
class ItemEntity
{
    protected $id;
    protected $name;
    protected $color;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        if(isset($data['Id'])) {
            $this->id = $data['Id'];
        }
        $this->name = $data['Name'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getColor() {
        return $this->color;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}