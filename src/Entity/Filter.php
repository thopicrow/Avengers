<?php


namespace App\Entity;


class Filter
{
    /**
     * @var string
     */
    private $site;

    /**
     * @var string
     */
    private $keyword;

    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \DateTime
     */
    private $dateFin;

    /**
     * @var boolean
     */
    private $organisateur;

    /**
     * @var boolean
     */
    private $inscrit;

    /**
     * @var boolean
     */
    private $nonInscrit;

    /**
     * @var boolean
     */
    private $past;

    /**
     * @var User
     */
    private $user;

    /**
     * @return string
     */
    public function getSite(): ?string
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    /**
     * @return string
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut(\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin(\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return bool
     */
    public function isOrganisateur(): ?bool
    {
        return $this->organisateur;
    }

    /**
     * @param bool $organisateur
     */
    public function setOrganisateur(bool $organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return bool
     */
    public function isInscrit(): ?bool
    {
        return $this->inscrit;
    }

    /**
     * @param bool $inscrit
     */
    public function setInscrit(bool $inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return bool
     */
    public function isNonInscrit(): ?bool
    {
        return $this->nonInscrit;
    }

    /**
     * @param bool $nonInscrit
     */
    public function setNonInscrit(bool $nonInscrit): void
    {
        $this->nonInscrit = $nonInscrit;
    }

    /**
     * @return bool
     */
    public function isPast(): ?bool
    {
        return $this->past;
    }

    /**
     * @param bool $past
     */
    public function setPast(bool $past): void
    {
        $this->past = $past;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }




}