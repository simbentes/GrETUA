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




                            $result = $writer->write($qrCode);



                            // Save it to a file
                            $result->saveToFile('img/qrcode.png');

                            ?>
                        </div>
                        <div class="row">
                            <div class="col text-cinza">4</div>
                            <div class="col text-cinza text-center">5</div>
                            <div class="col text-cinza text-end">Concerto</div>
                        </div>
                        <div class="text-center">
                            <img src="img/qrcode.png" class="qrcode">
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



