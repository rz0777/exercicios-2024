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
    $papers = $xpath->query("//*[contains(@class, 'paper-card p-lg bd-gradient-left')]");
    $papers_return = [];

    foreach ($papers as $paper) {
      /**Gets information needed for create a paper */
      $id = $xpath->query(".//div[contains(@class,'volume-info')]",$paper)->item(0)->textContent;

      $title = $xpath->query(".//h4[contains(@class,'my-xs paper-title')]",$paper)->item(0)->textContent;
      $tag = $xpath->query(".//div[contains(@class,'tags mr-sm')]",$paper)->item(0)->textContent;

      $authors_paper = [];
      $authors_div = $xpath->query(".//div[contains(@class,'authors')]",$node);
      $authors = $xpath->query(".//span",$authors_div);
      
      foreach($authors as $author){
        $person = new Person($author->textContent,$author->getAttribute("title"));
        array_push($authors_paper[],$person);
      }


      $paper_scrap = new Paper( $id,
                                $title,
                                $tag,
                                $authors);
      array_push($papers_return,$paper_scrap);


    }
      return $papers_return;
  }


}
