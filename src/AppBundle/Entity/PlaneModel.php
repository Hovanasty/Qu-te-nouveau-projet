<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlaneModel
 *
 * @ORM\Table(name="plane_model")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlaneModelRepository")
 */
class PlaneModel
{

    // Adding personal methods / variables
    public function __toString()
    {
        // Return  the site object with  "[] - [] - [] format, when __toString is called.
        return $this->plane. " - " . $this->model;
    }

    private $plane;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Flight", mappedBy="plane")
     */

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=128)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="manufactured", type="string", length=64, nullable=true)
     */
    private $manufactured;

    /**
     * @var int
     *
     * @ORM\Column(name="cruiseSpeed", type="smallint")
     */
    private $cruiseSpeed;

    /**
     * @var int
     *
     * @ORM\Column(name="planeNbSeats", type="smallint")
     */
    private $planeNbSeats;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return PlaneModel
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set manufactured
     *
     * @param string $manufactured
     *
     * @return PlaneModel
     */
    public function setManufactured($manufactured)
    {
        $this->manufactured = $manufactured;

        return $this;
    }

    /**
     * Get manufactured
     *
     * @return string
     */
    public function getManufactured()
    {
        return $this->manufactured;
    }

    /**
     * Set cruiseSpeed
     *
     * @param integer $cruiseSpeed
     *
     * @return PlaneModel
     */
    public function setCruiseSpeed($cruiseSpeed)
    {
        $this->cruiseSpeed = $cruiseSpeed;

        return $this;
    }

    /**
     * Get cruiseSpeed
     *
     * @return int
     */
    public function getCruiseSpeed()
    {
        return $this->cruiseSpeed;
    }

    /**
     * Set planeNbSeats
     *
     * @param integer $planeNbSeats
     *
     * @return PlaneModel
     */
    public function setPlaneNbSeats($planeNbSeats)
    {
        $this->planeNbSeats = $planeNbSeats;

        return $this;
    }

    /**
     * Get planeNbSeats
     *
     * @return int
     */
    public function getPlaneNbSeats()
    {
        return $this->planeNbSeats;
    }
}
