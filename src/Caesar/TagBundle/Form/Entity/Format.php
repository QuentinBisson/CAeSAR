<?php

namespace Caesar\TagBundle\Form\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Format
 *
 * @author Quentin
 */
class Format {

  private $marginLeft;
  private $marginTop;
  private $horizontalGap;
  private $verticalGap;
  private $height;
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