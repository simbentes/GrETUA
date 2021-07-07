<div class="bilhetes-container">
    <div class="swiper-container mySwiper">
        <div class="swiper-wrapper">


            <div class="bilhetes swiper-slide">
                <a href="evento.php?evento=1">
                    <div class="desc-bilhete container-fluid">
                        <h6 class="top-right">3</h6>
                        <div>
                            <?php
                            use Endroid\QrCode\Color\Color;
                            use Endroid\QrCode\Encoding\Encoding;
                            use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
                            use Endroid\QrCode\QrCode;
                            use Endroid\QrCode\Label\Label;
                            use Endroid\QrCode\Logo\Logo;
                            use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
                            use Endroid\QrCode\Writer\PngWriter;

                            $writer = new PngWriter();

                            // Create QR code
                            $qrCode = QrCode::create('Data')
                                ->setEncoding(new Encoding('UTF-8'))
                                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                                ->setSize(300)
                                ->setMargin(10)
                                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                                ->setForegroundColor(new Color(0, 0, 0))
                                ->setBackgroundColor(new Color(255, 255, 255));

                            // Create generic logo
                            $logo = Logo::create(__DIR__.'/assets/symfony.png')
                                ->setResizeToWidth(50);

                            // Create generic label
                            $label = Label::create('Label')
                                ->setTextColor(new Color(255, 0, 0));

                            $result = $writer->write($qrCode, $logo, $label);



                            // Directly output the QR code
                            header('Content-Type: '.$result->getMimeType());
                            echo $result->getString();

                            // Save it to a file
                            $result->saveToFile(__DIR__.'/qrcode.png');

                            // Generate a data URI to include image data inline (i.e. inside an <img> tag)
                            $dataUri = $result->getDataUri();


                            ?>
                        </div>
                        <div class="row">
                            <div class="col text-cinza">4</div>
                            <div class="col text-cinza text-center">5</div>
                            <div class="col text-cinza text-end">Concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bilhetes swiper-slide">
                <a href="evento.php?evento=1">
                    <div class="desc-bilhete container-fluid">
                        <h6 class="top-right">3</h6>
                        <div class="row">
                            <div class="col text-cinza">4</div>
                            <div class="col text-cinza text-center">5</div>
                            <div class="col text-cinza text-end">Concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bilhetes swiper-slide">
                <a href="evento.php?evento=1">
                    <div class="desc-bilhete container-fluid">
                        <h6 class="top-right">3</h6>
                        <div class="row">
                            <div class="col text-cinza">4</div>
                            <div class="col text-cinza text-center">5</div>
                            <div class="col text-cinza text-end">Concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bilhetes swiper-slide">
                <a href="evento.php?evento=1">
                    <div class="desc-bilhete container-fluid">
                        <h6 class="top-right">3</h6>
                        <div class="row">
                            <div class="col text-cinza">4</div>
                            <div class="col text-cinza text-center">5</div>
                            <div class="col text-cinza text-end">Concerto</div>
                        </div>
                    </div>
                </a>
            </div>



        </div>

        <div class="swiper-pagination"></div>

    </div>
</div>



