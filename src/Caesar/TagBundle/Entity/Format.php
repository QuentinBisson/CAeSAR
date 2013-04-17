<?php

namespace Caesar\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Caesar\TagBundle\Entity\FormatRepository")
 * @ORM\Table(name="format", uniqueConstraints={@ORM\UniqueConstraint(name="UNCodeFormat", columns={"code"})})
 */
class Format {

  /**
   * @var integer $id
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var int $codeBu
   *
   * @ORM\Column(name="code", type="string",length=20, unique=true)
   * @Assert\NotBlank()
   */
  private $code;

  /**
   *
   * @ORM\Column(name="marginleft", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type = "float", message = "validation.assert.error.type.margin.left")
   */
  private $marginLeft;

  /**
   *
   * @ORM\Column(name="margintop", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type="float", message="validation.assert.error.type.margin.top")
   */
  private $marginTop;

  /**
   *
   * @ORM\Column(name="hgap", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type="float", message="validation.assert.error.type.gap.horizontal")
   */
  private $horizontalGap;

  /**
   *
   * @ORM\Column(name="vgap", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type="float", message="validation.assert.error.type.gap.vertical")
   */
  private $verticalGap;

  /**
   *
   * @ORM\Column(name="height", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type="float", message="validation.assert.error.type.height")
   */
  private $height;

  /**
   *
   * @ORM\Column(name="width", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type="float", message="validation.assert.error.type.width")
   */
  private $width;

  /**
   *
   * @ORM\Column(name="columns", type="integer")
   * @Assert\NotBlank()
   * @Assert\Min(limit = "1", message = "validation.assert.error.columns.below.one")
   */
  private $columns;

  /**
   *
   * @ORM\Column(name="rows", type="integer")
   * @Assert\NotBlank()
   * @Assert\Min(limit = "1", message = "validation.assert.error.rows.below.one")
   */
  private $rows;

  /**
   *
   * @ORM\Column(name="pagewidth", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type = "float", message = "validation.assert.error.type.page.width")
   */
  private $pageWidth;

  /**
   *
   * @ORM\Column(name="pageheight", type="float")
   * @Assert\NotBlank()
   * @Assert\Type(type = "float", message = "validation.assert.error.type.page.height")
   */
  private $pageHeight;

  public function getId() {
    return $this->id;
  }

  public function getCode() {
    return $this->code;
  }

  public function setCode($code) {
    $this->code = $code;

    return $this;
  }

  public function getMarginLeft() {
    return $this->marginLeft;
  }

  public function setMarginLeft($marginLeft) {
    $this->marginLeft = $marginLeft;

    return $this;
  }

  public function getMarginTop() {
    return $this->marginTop;
  }

  public function setMarginTop($marginTop) {
    $this->marginTop = $marginTop;

    return $this;
  }

  public function getHorizontalGap() {
    return $this->horizontalGap;
  }

  public function setHorizontalGap($horizontalGap) {
    $this->horizontalGap = $horizontalGap;

    return $this;
  }

  public function getVerticalGap() {
    return $this->verticalGap;
  }

  public function setVerticalGap($verticalGap) {
    $this->verticalGap = $verticalGap;

    return $this;
  }

  public function getHeight() {
    return $this->height;
  }

  public function setHeight($height) {
    $this->height = $height;

    return $this;
  }

  public function getWidth() {
    return $this->width;
  }

  public function setWidth($width) {
    $this->width = $width;

    return $this;
  }

  public function getColumns() {
    return $this->columns;
  }

  public function setColumns($columns) {
    $this->columns = $columns;

    return $this;
  }

  public function getRows() {
    return $this->rows;
  }

  public function setRows($rows) {
    $this->rows = $rows;

    return $this;
  }

  public function getPageHeight() {
    return $this->pageHeight;
  }

  public function setPageHeight($pageHeight) {
    $this->pageHeight = $pageHeight;

    return $this;
  }

  public function getPageWidth() {
    return $this->pageWidth;
  }

  public function setPageWidth($pageWidth) {
    $this->pageWidth = $pageWidth;

    return $this;
  }

  /**
   * @Assert\True(message = "admin.validation.tag.format.hgap.over.width")
   */
  public function isHgapOverWidth() {
    return ($this->horizontalGap >= $this->width);
  }

  /**
   * @Assert\True(message = "admin.validation.tag.format.vgap.over.height")
   */
  public function isVgapOverHeight() {
    return ($this->verticalGap >= $this->height);
  }

  /**
   * @Assert\True(message = "admin.validation.tag.format.total.under.page.width")
   */
  public function isTotalUnderPageWidth() {
    $hgap = $this->horizontalGap - $this->width;
    return $this->pageWidth >= $this->marginLeft + (($this->columns - 1) * $hgap) + ($this->columns * $this->width);
  }

  /**
   * @Assert\True(message = "admin.validation.tag.format.total.under.page.height")
   */
  public function isTotalUnderPageHeight() {
    $vgap = $this->verticalGap - $this->height;
    return $this->pageHeight >= $this->marginTop + (($this->rows - 1) * $vgap) + ($this->rows * $this->height);
  }

  public function getJsonData() {
    return get_object_vars($this);
  }

}