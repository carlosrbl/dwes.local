<?php
require_once "iEntity.class.php";

class Categoria implements IEntity
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var int
     */
    private $numImagenes;
    public function __construct($nombre = "", $numImagenes = 0)
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes()
        ];
    }
    /**
     * @return int
     */
    public function getID(): ?int
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    /**
     * @return int
     */
    public function getNumImagenes(): ?int
    {
        return $this->numImagenes;
    }
    /**
     * @param $nombre
     * @return Categoria
     */
    public function setNombre($nombre): Categoria
    {
        $this->nombre = $nombre;
        return $this;
    }
    /**
     * @param $numImagenes
     * @return Categoria
     */
    public function setNumImagenes($numImagenes): Categoria
    {
        $this->numImagenes = $numImagenes;
        return $this;
    }
}
