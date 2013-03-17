<?php

namespace Caesar\TagBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Format
 *
 * @author Quentin
 */
class Format {

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.margin.left")
     */
  private $marginLeft;

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.margin.top")
     */
  private $marginTop;

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.gap.horizontal")
     */
  private $horizontalGap;

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.gap.vertical")
     */
  private $verticalGap;

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.height")
     */
  private $height;

  /**
     * @Assert\Type(type="float", message="validation.assert.error.type.width")
     */
  private $width;

  /**
   * @Assert\Min(limit = "1", message = "validation.assert.error.columns.below.one")
   */
  private $columns;

  /**
   * @Assert\Min(limit = "1", message = "validation.assert.error.rows.below.one")
   */
  private $rows;

  public function getMarginLeft() {
    return $this->marginLeft;
  }

  public function setMarginLeft($marginLeft) {
    $this->marginLeft = $marginLeft;
  }

  public function getMarginTop() {
    return $this->marginTop;
  }

  public function setMarginTop($marginTop) {
    $this->marginTop = $marginTop;
  }

  public function getHorizontalGap() {
    return $this->horizontalGap;
  }

  public function setHorizontalGap($horizontalGap) {
    $this->horizontalGap = $horizontalGap;
  }

  public function getVerticalGap() {
    return $this->verticalGap;
  }

  public function setVerticalGap($verticalGap) {
    $this->verticalGap = $verticalGap;
  }

  public function getHeight() {
    return $this->height;
  }

  public function setHeight($height) {
    $this->height = $height;
  }

  public function getWidth() {
    return $this->width;
  }

  public function setWidth($width) {
    $this->width = $width;
  }

  public function getColumns() {
    return $this->columns;
  }

  public function setColumns($columns) {
    $this->columns = $columns;
  }

  public function getRows() {
    return $this->rows;
  }

  public function setRows($rows) {
    $this->rows = $rows;
  }

}