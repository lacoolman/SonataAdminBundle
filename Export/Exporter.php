<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\AdminBundle\Export;

use Exporter\Source\SourceIteratorInterface;
use Symfony\Component\HttpFoundation\Response;
use IronSoft\Analytics\ISBundle\Exporter\Handler;

class Exporter
{
    /**
     * @throws \RuntimeException
     *
     * @param string                                   $format
     * @param string                                   $filename
     * @param \Exporter\Source\SourceIteratorInterface $source
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponse($format, $filename, SourceIteratorInterface $source, $options = [])
    {
        $privateFilename = sprintf('%s/%s', sys_get_temp_dir(), uniqid('sonata_export_', true));

        switch ($format) {
            case 'xls':
                $writer      = new \Exporter\Writer\XlsWriter($privateFilename);
                $contentType = 'application/vnd.ms-excel';
                break;
            case 'pdf':
                $writer      = new \Exporter\Writer\PdfWriter($privateFilename);
                $contentType = 'application/pdf';
                break;
            case 'xml':
                $writer      = new \Exporter\Writer\XmlWriter($privateFilename);
                $contentType = 'text/xml';
                break;
            case 'json':
                $writer      = new \Exporter\Writer\JsonWriter($privateFilename);
                $contentType = 'application/json';
                break;
            case 'csv':
                $writer      = new \Exporter\Writer\CsvWriter($privateFilename, ',', '"', "", true);
                $contentType = 'text/csv';
                break;
            default:
                throw new \RuntimeException('Invalid format');
        }

        $handler = Handler::create($source, $writer, $options);
        $handler->export();

        $response = new Response(file_get_contents($privateFilename), 200, array(
            'Content-Type'        => $contentType,
            'Content-Disposition' => sprintf('attachment; filename=%s', $filename)
        ));

        unlink($privateFilename);

        return $response;
    }
}