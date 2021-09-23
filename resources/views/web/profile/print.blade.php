



<style>

.input {
  outline: 0;
  border: 0;
  background: 0;
  padding: 0;
  -webkit-appearance: none;
  width: 100%;
}

.products-details .details {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 116px;
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

@media all and (max-width: 375px) {
  .products-details .details .item {
    display: block;
  }
}


.products-details .details .item .certification-info {
  position: absolute;
  left:35%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.products-details .details .item .certification-info .certification-head {
  margin-bottom: 81px;
}

.products-details .details .item .certification-info .certification-head label {
  font-size: 18px;
  color: #a1a1a1;
}

.products-details .details .item .certification-info .certification-head .input {
  color: #015CAB;
  font-size: 58px;
}

.products-details .details .item .certification-info .certification-body .grid-container {
  display: -ms-grid;
  display: grid;
  grid-gap: 64px 0;
  grid-template-columns: auto auto;
}

.products-details .details .item .certification-info .certification-body span,
.products-details .details .item .certification-info .certification-body  label {
  font-size: 16px;
  color: #A1A1A1;
}

.products-details .details .item .certification-info .certification-body .input {
  color: #015CAB;
  font-size: 27px;
}

.products-details .details .right-side {
  margin-left: auto;
}

.products-details .details .right-side .info {
  background: #f5f5f5;
  width: 346px;
  height: 138px;
  border-radius: 6px;
}

.products-details .details .right-side p {
  border-bottom: 1px solid #d4d4d4;
  padding: 23px 20px;
  color: #a1a1a1;
  font-size: 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.products-details .details .right-side p:last-child {
  border-bottom: 0;
}

.products-details .details .right-side p span {
  color: #015CAB;
  margin-left: auto;
}

.products-details .details .certification {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.products-details .details .certification .item-info {
  font-size: 20px;
  padding-left: 9px;
}

.products-details .details .certification .item-info h4 {
  color: #015CAB;
}

.products-details .details .certification .item-info span {
  color: #a1a1a1;
}

.products-details .details .buttons .btn {
  font-size: 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  margin-right: 19px;
  margin-top: 46px;
  height: 45px;
}

.products-details .details .buttons .btn:last-child {
  margin-right: 0;
}

.products-details .details .buttons .btn figure {
  padding-right: 10px;
}

.products-details .details .buttons .download {
  width: 193px;
}

.products-details .details .buttons .print {
  width: 134px;
}

@media all and (max-width: 768px) {
  .products-details .details {
    display: block;
  }
  .products-details .details .right-side {
    margin-top: 30px;
  }
}

.products-details .products {
  text-align: left;
}

@media all and (max-width: 768px) {
  .products-details .products .item {
    display: block;
  }
}

.products-details .products .grid-container {
  padding: 12px 0;
  text-align: center;
}

@media all and (max-width: 768px) {
  .products-details .products .grid-container {
    -ms-grid-columns: auto auto;
        grid-template-columns: auto auto;
  }
}

@media all and (max-width: 375px) {
  .products-details .products .grid-container {
    -ms-grid-columns: auto;
        grid-template-columns: auto;
  }
}
@media print {

  a[href]:after {
    content: " (" attr(href) ")";
  }
 
}

</style>

 
<main >
        <div  id="main" class="products-details">
            <div class="container">
                    <div class="details">
                        <div class="item">
                            <figure>
                                <img src="{{ asset('web_files/images/certification.png') }} " alt="">
                            </figure>
                            <div class="certification-info">
                                <div class="certification-head">
                                    <label>
                                        Certificate No. {{$virtualpaymenthistory->certificate_no}}
                                    </label>
                                    <input class="input" type="text" value=" {{$virtualpaymenthistory->quantity}}  grams gold 24K" readonly>
                                </div>
                                <div class="certification-body">
                                    <div class="grid-container">
                                        <div class="grid-item">
                                            <label>
                                                Customer Name
                                            </label>
                                            <input type="text" class="input" value="{{Auth::guard('website')->user()->first_name . ' ' . Auth::guard('website')->user()->last_name }}" readonly>
                                        </div>
                                        <div class="grid-item">
                                            <label>
                                                Customer ID
                                            </label>
                                            <input type="number" class="input" value="{{Auth::guard('website')->user()->national_id  }}" readonly>
                                        </div>
                                        <div class="grid-item">
                                            <label>
                                                Issuing date
                                            </label>
                                            <input type="text" class="input" value=" {{$virtualpaymenthistory->created_at}}" readonly>
                                        </div>

                                        <div class="grid-item">
                                            <span>
                                            Manager signature
                                          </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                    </div>
            </div>
        </div>
      

    </main>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>


    <script>
          window.print();

           /* $( document ).ready(function() {
                
         var printpage= document.getElementById('main');

             var headstr = "<html><title></title></head><body>";
            var footstr = "</body>";
            
            var oldstr = document.body.innerHTML;
            document.body.innerHTML =oldstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
   

    
                });*/
        

    </script>
    


