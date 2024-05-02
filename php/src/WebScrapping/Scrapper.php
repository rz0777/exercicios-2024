<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;


/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    /**Set xpath for query search */
    $xpath = new \DOMXpath($dom);
    $papers = $xpath->query(".//a[contains(@class, 'paper-card p-lg bd-gradient-left')]");
    $papers_return = [];

    foreach ($papers as $paper) {
      /**Gets information needed for create a paper */
      $id = $xpath->query(".//div[contains(@class,'volume-info')]",$paper)[0]->textContent;

      $title = $xpath->query(".//h4[contains(@class,'my-xs paper-title')]",$paper)[0]->textContent;
      $tag = $xpath->query(".//div[contains(@class,'tags mr-sm')]",$paper)[0]->textContent;

      $authors_paper = [];
      $authors_div = $xpath->query(".//div[contains(@class,'authors')]",$paper);
      $authors = $xpath->query(".//span",$authors_div[0]);

      foreach($authors as $author){
        $person = new Person($author->textContent,$author->getAttribute("title"));
        array_push($authors_paper,$person);
      }
      /**Crate paper and add to return array */

      $paper_scrap = new Paper( $id,
                                $title,
                                $tag,
                                $authors_paper);
      array_push($papers_return,$paper_scrap);


    }
      return $papers_return;
  }


}
