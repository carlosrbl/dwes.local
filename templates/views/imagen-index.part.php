           <div id="category<?=$idCategoria?>" class="tab-pane active" >
              <div class="row popup-gallery">
                <?php
                    foreach ($imagenesHome as $img) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="sol">
                <img class="img-responsive" src="<?= $img->getUrlPortfolio()?>" alt="<?= $img->getDescripcion()?>">
                  <div class="behind">
                      <div class="head text-center">
                        <ul class="list-inline">
                          <li>
                            <a class="gallery" href="<?= $img->getUrlGaleria()?>" data-toggle="tooltip" data-original-title="Quick View">
                              <i class="fa fa-eye"></i>
                            </a>
                          </li>
                          <li>
                            <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
                              <i class="fa fa-heart"></i>
                            </a>
                          </li>
                          <li>
                            <a href="#" data-toggle="tooltip" data-original-title="Download">
                              <i class="fa fa-download"></i>
                            </a>
                          </li>
                          <li>
                            <a href="#" data-toggle="tooltip" data-original-title="More information">
                              <i class="fa fa-info"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="row box-content">
                        <ul class="list-inline text-center">
                          <li><i class="fa fa-eye"></i> <?= $img->getNumVisualizaciones()?></li>
                          <li><i class="fa fa-heart"></i> <?= $img->getNumLikes()?></li>
                          <li><i class="fa fa-download"></i> <?= $img->getNumDownloads()?></li>
                        </ul>
                      </div>
                  </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <nav class="text-center">
                <ul class="pagination">
                  <?php 
                    if ($idCategoria === 1)
                    {
                      ?>
                      <li class="active"><a href="#">1</a></li>
                      <?php
                    }
                    else
                    {
                      ?>
                      <li><a href="#">1</a></li>
                      <?php
                    }  
                  ?>
                  <?php 
                    if ($idCategoria === 2)
                    {
                      ?>
                      <li class="active"><a href="#">2</a></li>
                      <?php
                    }
                    else
                    {
                      ?>
                      <li><a href="#">2</a></li>
                      <?php
                    }  
                  ?>
                  <?php 
                    if ($idCategoria === 3)
                    {
                      ?>
                      <li class="active"><a href="#">3</a></li>
                      <?php
                    }
                    else
                    {
                      ?>
                      <li><a href="#">3</a></li>
                      <?php
                    }  
                  ?>
                  <li><a href="#" aria-label="suivant">
                    <span aria-hidden="true">&raquo;</span>
                  </a></li>
                </ul>
        </nav>
    </div>