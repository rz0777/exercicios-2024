<?php
    
    namespace Chuva\Php\WebScrapping;

    use OpenSpout\Writer\Common\Creator\WriterEntityFactory;
    use OpenSpout\Common\Entity\Row;

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

            $writer = WriterEntityFactory::createXLSXWriter();

            $filePath = __DIR__ . '../../../assets/planilha.xlsx';
            $writer->openToFile($filePath);

            foreach ($papers as $paper) {
                $data = [
                    $paper->id,
                    $paper->title,
                    $paper->type,
                ];
    
                foreach ($paper->authors as $author) {
                    $data[] = $author->name;
                    $data[] = $author->institution;
                }
    
                $row = WriterEntityFactory::createRowFromArray($data);
                $writer->addRow($row);
            }
    
            $writer->close();

        }

    }