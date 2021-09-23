<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>



  <style>
    .input {
      outline: 0;
      border: 0;
      background: 0;
      padding: 0;
      -webkit-appearance: none;
      width: 100%;
    }

    .products-details .details .item {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-flex: 1;
      -ms-flex: 1;
      flex: 1;
      position: relative;
    }

    .products-details .details .item .certification-info {
      position: absolute;
      left: 35%;
      top: 40%;
      -webkit-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

    .products-details .details .item .certification-info .certification-head {
      margin-bottom: 60px;
      position: relative;

    }

    .products-details .details .item .certification-info .certification-head label {
      font-size: 18px;
      color: #a1a1a1;
      position: absolute;
      top: -30px;
    }

    .products-details .details .item .certification-info .certification-head .input {
      color: #015CAB;
      font-size: 30px;

    }

    .products-details .details .item .certification-info .certification-body span,
    .products-details .details .item .certification-info .certification-body label {
      font-size: 16px;
      color: #A1A1A1;


    }

    .products-details .details .item .certification-info .certification-body .input {
      color: #015CAB;
      font-size: 20px;
    }

    .products-details .details .item .certification-info .certification-body .grid-container .grid-item {
      position: relative;
      margin-top: 24px;


    }

    .products-details .details .item .certification-info .certification-body label {
      margin-top: 15px;
      position: absolute;
      top: -20px;
    }

  
  </style>
</head>

<body>
  <div class="products-details">
    <div class="container">
      <div class="details">
        <div class="item">
          <figure>
            <img src="{{ public_path('web_files/images/certification.png') }} " width="700px" height="700px" alt="">
          </figure>

          <div class="certification-info">
            <div class="certification-head">
              <label>
                Certificate No. {{$virtualpaymenthistory->certificate_no}}
              </label>
              <input class="input" type="text" value=" {{$virtualpaymenthistory->quantity}}  grams gold 24K" readonly>
            </div>
            <div class="certification-body">
              <div class="grid-container" style="position:relative">
                <div class="row-1">
                  <div class="grid-item">
                    <label>
                      Customer Name
                    </label>
                    <input type="text" class="input" value="{{Auth::guard('website')->user()->first_name . ' ' . Auth::guard('website')->user()->last_name }}" readonly>
                  </div>
                  <div class="grid-item">
                    <label>
                      Issuing date
                    </label>
                    <input type="text" class="input" value=" {{$virtualpaymenthistory->created_at}}" readonly>

                  </div>
                </div>
              </div>
              <div class="row-2" style="position: absolute; top:24%; left:60%;">
                <div class="grid-item" style="margin-bottom:25px;">
                  <label>
                    Customer ID
                  </label>
                  <input type="text" class="input" value="{{Auth::guard('website')->user()->national_id  }}" readonly>
                </div>
                <div class="grid-item">
                <label>
                      Customer Name
                    </label>
                    <input type="text" class="input" value="{{Auth::guard('website')->user()->first_name . ' ' . Auth::guard('website')->user()->last_name }}" readonly>
                  </div>

                  </div>
                <!-- <div class="grid-item">
                  <span>
                    Manager signature
                  </span>
                 
                </div> -->

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
  </div>
  </div>

</body>

</html>