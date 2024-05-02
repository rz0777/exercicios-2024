<?php
    
    namespace Chuva\Php\WebScrapping;

    use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
    use Box\Spout\Common\Entity\Row;

    class SproutWriter{
        /**Takes scrapped information and turns into a excel sheet */

        public static function Write(array $papers): void{
            $source = __DIR__ . '../../../assets/model.xlsx';
            $destination = __DIR__ . '../../../assets/planilha.xlsx';

            if( !copy($source, $destination) ) {  
                echo "File can't be copied! \n";  
            }  
            else {  
                echo "File has been copied! \n";  
            }

        }

    }