<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ URL::asset('frontend/Home-Css.css') }}" style type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('css/boostrap.css') }}">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ URL::asset('css/min.css') }}">
  <!-- Material Design Bootstrap Ecommerce -->
  <link rel="stylesheet" href="{{ URL::asset('css/ecommerce.css') }}">
  <title>CANCARD INC</title>
</head>

<body>
  <div class="input-group">
    <nav class="navbar">

      <div class="row ">
        <div class="col-3 rowinline">

          <a class="navbar-brand" href="#">
            <img src="{{ URL::asset('frontend/image/cancard-logo.png') }}" width="220" height="45" alt="">
          </a>
        </div>
        <div class="col-6 bg-dark rowinline ">
          <div id='search-box'>
            <form action='/search' id='search-form' method='get' target='_top'>
              <input id='search-text' placeholder='Enter Keyword,Item,Model or Part #' type='text' />
              <button id='search-button' class="searchicon" type='submit'><img src="{{ URL::asset('frontend/image/searchbar.svg') }}"
                  alt="My search SVG" /></span></button>
            </form>
          </div>
        </div>
       
        <div class="col-3  bg-dark rowinline pt-2">
          <div class="dropdown show">
            <a class="btn btndrop text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Bulk Order
            </a>
    
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="btn btndrop text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              My Account
            </a>
    
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
            </div>
          </div>
          <button id='shopping-button' class="bg-dark" type='button'><img src="{{ URL::asset('frontend/image/shoppingCartnavbar.png') }}"
              alt="My cart SVG" /></span></button>
        </div>
      </div>
    
    </nav>
  </div>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Product listing
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">ID card Printers</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Medication Carts</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Metal Marketing</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Procedure Carts</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Plastic Card Embossers</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Imprinters</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">E-store</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">service & support</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                industries
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Healthcare</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Corporate</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Education</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Central Issuance</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Government</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Industrial Goods</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="jumbotron color-grey-light ">
      <div class="d-flex align-items-center h-100">
        <div class="container text-center py-2">
          <h3 class="mb-0">Product detail page</h3>
        </div>
      </div>
    </div>

    <div class="container">

      <!--Section: Block Content-->
      <section class="mb-5">

        <div class="row">
          <div class="col-md-6 mb-4 mb-md-0">

            <div id="mdb-lightbox-ui"></div>

            <div class="mdb-lightbox">

              <div class="row product-gallery mx-1">

                <div class="col-12 mb-0">
                  <figure class="view overlay rounded z-depth-1 main-img" style="max-height: 450px;">
                    <a href="#"
                      data-size="710x823">
                      <img src="product image/pexels-photo-4541395.jpeg"
                        class="img-fluid z-depth-1" >
                    </a>
                  </figure>
                  <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                    <a href="#"
                      data-size="710x823">
                      <img src="product image/pexels-photo-4541397.jpeg"
                        class="img-fluid z-depth-1">
                    </a>
                  </figure>
                  <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">https://mdbo
                    <a href="#"
                      data-size="710x823">
                      <img src="product image/pexels-photo-4841460.jpeg"
                        class="img-fluid z-depth-1">
                    </a>
                  </figure>
                  <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                    <a href="#"
                      data-size="710x823">
                      <img src="product image/pexels-photo-5734904.jpeg"
                        class="img-fluid z-depth-1">
                    </a>
                  </figure>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-3">
                      <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                        <img src="product image/pexels-photo-4541395.jpeg"
                          class="img-fluid">
                        <div class="mask rgba-white-slight"></div>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                        <img src="product image/pexels-photo-4541397.jpeg"
                          class="img-fluid">
                        <div class="mask rgba-white-slight"></div>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                        <img src="product image/pexels-photo-4841460.jpeg"
                          class="img-fluid">
                        <div class="mask rgba-white-slight"></div>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                        <img src="product image/pexels-photo-5734904.jpeg"
                          class="img-fluid">
                        <div class="mask rgba-white-slight"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <div class="col-md-6">

            <h5>RETRANSFER PRINTER</h5>
            <p class="mb-2 text-muted text-uppercase small">Printer</p>
           
            <p><span class="mr-1"><strong>$179</strong></span></p>
            <ul class="rating">
              <li class="fa fa-star checked"></li>
              <li class="fa fa-star checked"></li>
              <li class="fa fa-star checked"></li>
              <li class="fa fa-star checked"></li>
              <li class="fa fa-star "></li>
          </ul>
          
            <p class="pt-1">Matica’s XID8600 is a premium quality micro printer, perfectly suited for the most demanding ID card programs. It is right choice for government, corporate or financial applications.
              KEY STRENGTH: 600X600 dpi; micro-text; up to 120 cards per hour; very high print quality.</p>
            <div class="table-responsive">
              <table class="table table-sm table-borderless mb-0">
                <tbody>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Brand</strong></th>
                    <td>Viltage</td>
                  </tr>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Model</strong></th>
                    <td>XID8600</td>
                  </tr>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Method </strong></th>
                    <td>Dye sublimation</td>
                  </tr>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Mode</strong></th>
                    <td>Retransfer</td>
                  </tr>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Resolution </strong></th>
                    <td>600 dpi</td> 
                  </tr>
                  <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Speed</strong></th>
                    <td>120 cph</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr>
            <div class="table-responsive mb-2">
              <table class="table table-sm table-borderless">
                <tbody>
                  <tr>
                    <td class="pl-0 pb-0 w-25">Quantity</td>
                    <td class="pb-0">Select size</td>
                  </tr>
                  <tr>
                    <td class="pl-0">
                      
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="50" step="1"
                  value="1" style="position: relative;
                  width: 70px; cursor: pointer;">
                    </td>
                    <td>
                      <div class="mt-1">
                        <div class="form-check form-check-inline pl-0">
                          <input type="radio" class="form-check-input" id="small" name="materialExampleRadios" checked>
                          <label class="form-check-label small text-uppercase card-link-secondary"
                            for="small">Small</label>
                        </div>
                        <div class="form-check form-check-inline pl-0">
                          <input type="radio" class="form-check-input" id="medium" name="materialExampleRadios">
                          <label class="form-check-label small text-uppercase card-link-secondary"
                            for="medium">Medium</label>
                        </div>
                        <div class="form-check form-check-inline pl-0">
                          <input type="radio" class="form-check-input" id="large" name="materialExampleRadios">
                          <label class="form-check-label small text-uppercase card-link-secondary"
                            for="large">Large</label>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <button type="button" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
            <button type="button" class="btn btn-light btn-md mr-1 mb-2">Add to
              cart</button>
          </div>
        </div>

      </section>
      <!--Section: Block Content-->

      <!-- Classic tabs -->
      <div class="classic-tabs">

        <ul class="nav tabs-primary nav-justified" id="advancedTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="description-tab" data-toggle="tab" href="#description" role="tab"
              aria-controls="description" aria-selected="true">Description</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
              aria-selected="false">Information</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
              aria-selected="false">Reviews (1)</a>
          </li>
        </ul>
        <div class="tab-content" id="advancedTabContent">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
            <h5>Product Description</h5>
            <p class="small text-muted text-uppercase mb-2">RETRANSFER PRINTER</p>

              <ul class="rating">
                <li class="fa fa-star checked"></li>
                <li class="fa fa-star checked"></li>
                <li class="fa fa-star checked"></li>
                <li class="fa fa-star disable"></li>
                <li class="fa fa-star disable"></li>
            </ul>
            <h6>$179</h6>
            <p class="pt-1">Matica’s XID8600 is a premium quality micro printer, perfectly suited for the most demanding ID card programs. It is capable of producing up to 120 single-sided cards per hour, though a double-sided configuration is also available. As a part of Matica’s XID Series 8 family, this 600 dpi card printer relies on over-the-edge dye
              sublimation retransfer technology to achieve top-notch results. The outstanding image quality, high security standards, micro print, as well as its adaptability, make this model the right choice for government, corporate or financial applications.
              
              High-security ID cards, such as national IDs, driver’s licenses or employee access cards require extra care to prevent replication and tampering. The XID8600 unit itself comes equipped with diverse standard security features such as an electronic lock, Kensington-lock and IPsec data encryption.</p>
          </div>
          <!-- <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
            <h5>Additional Information</h5>
            <table class="table table-striped table-bordered mt-3">
              <thead>
                <tr>
                  <th scope="row" class="w-150 dark-grey-text h6">Weight</th>
                  <td><em>0.3 kg</em></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="w-150 dark-grey-text h6">Dimensions</th>
                  <td><em>50 × 60 cm</em></td>
                </tr>
              </tbody>
            </table>
          </div> -->
          <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
            <h5><span>1</span> review for <span>RETRANSFER PRINTER</span></h5>
            <div class="media mt-3 mb-4">
              <img class="d-flex mr-3 z-depth-1" src="image/Hydrangeas.jpg"
                width="62" alt="Generic placeholder image">
              <div class="media-body">
                <div class="d-flex justify-content-between">
                  <p class="mt-1 mb-2">
                    <strong>Marthasteward </strong>
                    <span>– </span><span>January 28, 2021</span>
                  </p>
                  <ul class="rating mb-0">
                    <style>  
                      .checked {  
                          color : orange;  
                           
                      }  
                      
                  </style>  
                  
                    <li>
                      <i class="fa fa-star checked"></i>
                    </li>
                    <li>
                      <i class="fa fa-star checked"></i>
                    </li>
                    <li>
                      <i class="fa fa-star checked"></i>
                    </li>
                    <li>
                      <i class="fa fa-star checked"></i>
                    </li>
                    <li>
                      <i class="fa fa-star checked"></i>
                    </li>
                  </ul>
                </div>
                <p class="mb-0">Nice one, love it!</p>
              </div>
            </div>
            <hr>
            <h5 class="mt-4">Add a review</h5>
            <p>Your email address will not be published.</p>
            <div class="my-3">
              <ul class="rating mb-0">
                <li>
                  <a href="#!">
                    <i class="fa fa-star checked"></i>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <i class="fa fa-star checked"></i>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <i class="fa fa-star checked"></i>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <i class="fa fa-star checked"></i>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <i class="fa fa-star checked"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div>
              <!-- Your review -->
              <div class="md-form md-outline">
                <textarea id="form76" class="md-textarea form-control pr-6" rows="4"></textarea>
                <label for="form76">Your review</label>
              </div>
              <!-- Name -->
              <div class="md-form md-outline">
                <input type="text" id="form75" class="form-control pr-6 require">
                <label for="form75">Name</label>
              </div>
              <!-- Email -->
              <div class="md-form md-outline">
                <input type="email" id="form77" class="form-control pr-6">
                <label for="form77">Email</label>
              </div>
              <div class="text-right pb-2">
                <button type="submit" class="btn btn-primary">Add a review</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- Classic tabs -->

      <hr>

      <!--Section: Block Content-->
      

        <h4 class="text-center my-5"><strong>Related products</strong></h4>

        <section id="products ">
          <div class="container text-center">
              <div class="row pb-5">
                  <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                      <div class="card"> <img class="card-img-top" src="product image/pexels-photo-4541395.jpeg" alt="Card image cap">
                          <div class="card-body">
                              <p class="card-text str ">MEDICATION CARTS</p>
                              <p>$90</p>
                              <a href="#"><img src="image/cart-product.png" class="p-1"> </a>
                              <a href="#"><img src="image/quick-view-product.png" class="p-1"> </a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 offset-lg-0 col-sm-4 offset-sm-2 col-11 offset-1">
                      <div class="card"> <img class="card-img-top" src="product image/pexels-photo-4541397.jpeg" alt="Card image cap">
                          <div class="card-body">
                              <p class="card-text">PROCEDURE CARTS</p>
                              <p>$100</p> 
                              <a href="#"><img src="image/cart-product.png" class="p-1"> </a>
                              <a href="#"><img src="image/quick-view-product.png" class="p-1"> </a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                      <div class="card"> <img class="card-img-top" src="product image/pexels-photo-4841460.jpeg" alt="Card image cap">
                          <div class="card-body">
                              <p class="card-text">ID CARD IMPRINTERS</p>
                              <p>$950</p> <a href="#"><img src="image/cart-product.png" class="p-1"> </a>
                              <a href="#"><img src="image/quick-view-product.png" class="p-1"> </a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-sm-4 offset-lg-0 offset-sm-2 col-11 offset-1">
                      <div class="card"> <img class="card-img-top" src="product image/pexels-photo-5734904.jpeg" alt="Card image cap">
                          <div class="card-body">
                              <p class="card-text">MEDICATION CABINETS</p>
                              <p>$390</p> <a href="#"><img src="image/cart-product.png" class="p-1"> </a>
                              <a href="#"><img src="image/quick-view-product.png" class="p-1"> </a>
                          </div>
                      </div>
                  </div>
              </div>
              
          </div>
      </section>
     
      <!--Section: Block Content-->

    </div>
  </main>
  <!--Main layout-->

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>