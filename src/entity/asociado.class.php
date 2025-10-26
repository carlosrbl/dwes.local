<?php
    require_once "iEntity.class.php";
class Asociado implements IEntity
{
    const RUTA_LOGOS_ASOCIADOS = '/public/images/asociados/';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $logo;
    /**
     * @var string
     */
    private $descripcion;

    public function __construct($nombre = "", $logo = "", $descripcion = "")
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'logo' => $this->getLogo()
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
     * @param $nombre
     * @return Asociado
     */
    public function setNombre($nombre): Asociado
    {
        $this->nombre = $nombre;
        return $this;
    }
    /**
     * @return string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }
    /**
     * @param $logo
     * @return Asociado
     */
    public function setLogo($logo): Asociado
    {
        $this->logo = $logo;
        return $this;
    }
    /**
     * @return string
     */
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }
    /**
     * @param $descripcion
     * @return Asociado
     */
    public function setDescripcion($descripcion): Asociado
    {
        $this->descripcion = $descripcion;
        return $this;
    }
    public function __toString(): string
    {
        return $this->descripcion;
    }
    public function getUrlAsociados(): string
    {
        return self::RUTA_LOGOS_ASOCIADOS . $this->getLogo();
    }
}
