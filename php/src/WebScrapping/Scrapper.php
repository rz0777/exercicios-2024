<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

use DOMXPath;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    $xpath = new DOMXpath($dom);
    $papers = $xpath->query("//a[contains(@class, 'paper-card']");

    foreach ($papers as $paper) {
      $id->$xpath->query("//div[contains(@class,'volume-info'");
      
    }
  }

}
