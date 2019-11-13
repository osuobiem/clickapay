<?php

class SPA
{
  
  public static function view($display, $data = []) {
    switch ($display) {
      case 'profile':
        return '
              <div class="overflow-hidden mb-1">
              <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">My</strong> Profile</h2>
              </div>
              <div class="overflow-hidden mb-1 pb-2">
                <p class="mb-0">You can update your personal information, password and profile picture.</p>
              </div>

              <form id="proForm" enctype="multipart/form-data" method="post" class="needs-validation" novalidate="novalidate">
                <div class="alert alert-danger alert-dismissible" id="proError" style="display: none">
                </div>
                <div class="form-row">
                  <div class="form-group col" style="padding: 0;">
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Firstname <span style="color: #ff0000">*</span></label>
                      <input type="text" id="firstname" style="font-size: 1rem;" value="'.$_SESSION['user']->firstname.'"
                        class="form-control form-control-lg" required="" placeholder="Your first name">
                    </div>
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Lastname <span style="color: #ff0000">*</span></label>
                      <input type="text" id="lastname" style="font-size: 1rem;" value="'.$_SESSION['user']->lastname.'"
                        class="form-control form-control-lg" required="" placeholder="Your last name">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col" style="padding: 0;">
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Email</label>
                      <input type="email" id="pro-email" style="font-size: 1rem;" disabled value="'.$_SESSION['user']->email.'"
                        class="form-control form-control-lg" required="" placeholder="mail@example.com">
                    </div>
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Phone <span style="color: #ff0000">*</span></label>
                      <input type="tel" size="11" minlength="11" maxlength="11" pattern="[0-9]{11}" id="pro-phone"
                        style="font-size: 1rem;" value="'.$_SESSION['user']->phone.'" class="form-control
                                form-control-lg" required="" placeholder="08012345678">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col" style="padding: 15px; padding-top: 0; margin-bottom: 0;">
                    <label class="font-weight-bold text-dark text-2">Password</label>
                    <div class="input-group">
                      <input type="password" id="pro-password" placeholder="Leave empty to retain password" style="font-size: 1rem;"
                        value="" class="form-control form-control-lg">
                      <span class="input-group-append">
                        <span class="input-group-text" id="showProPass"
                          style="background: #fff; border: solid .5px #dadbd9; border-left: 0;">
                          <i id="proEye" class="fas fa-eye-slash" style="font-size: 12px;"></i>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
                  <div class="form-group">
                    <input type="submit" id="saveButton" value="Save" class="btn btn-primary btn-modern float-right"
                      data-loading-text="Loading...">
                  </div>
                </div>
              </form>
              <div class="bounce-loader" style="display: none" id="proLoader">
                <div style="background: #558b2fd9;" class="bounce1"></div>
                <div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
                <div style="background: #558b2fd9;" class="bounce3"></div>
              </div>
              <script src="'.base_url().'main-assets/js/custom.js"></script>';
        break;
      
        case 'bank':
              $banks = '';
              foreach($_SESSION['data']['banks'] as $bank) {
                $banks.='<option value="'.base64_encode($bank->id).'">'.$bank->name.'</option>';
              }

              return '
              <div class="overflow-hidden mb-1">
                <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Bank</strong> Details
                </h2>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0">Add or update your bank account information.</p>
                <p class="mb-2"><strong class="font-weight-extra-bold" style="color: #ff0000c7">Note:</strong> We only support bank transfer.</p>
              </div>
              <form id="bankForm" method="post" class="needs-validation"
                novalidate="novalidate">
                <div class="alert alert-danger alert-dismissible" id="baError" style="display: none">
                </div>
                <div class="form-row">
                  <div class="form-group col" style="padding: 0;">
                    <div class="col-sm-12" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Account Name <span
                          style="color: #ff0000">*</span></label>
                      <input type="text" id="baAcct" style="font-size: 1rem;"
                         class="form-control form-control-lg" required=""
                        placeholder="Your Account Name">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col" style="padding: 0;">
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Bank</label> <span
                        style="color: #ff0000">*</span>
                      <select id="baBank" style="font-size: 1rem;" class="form-control form-control-lg"
                        required>'.
                          $banks.'</select>
                    </div>
                    <div class="col-sm-6" style="float: left;">
                      <label class="font-weight-bold text-dark text-2">Account Number <span
                          style="color: #ff0000">*</span></label>
                      <input type="number" minlength="8" maxlength="12" pattern="[0-9]{12}" id="baNumber"
                        style="font-size: 1rem;" class="form-control
                                form-control-lg" required="" placeholder="Your Account Number">
                    </div>
                  </div>
                </div>
                <div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
                  <div class="form-group">
                    <input type="submit" id="baButton" value="Save"
                      class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
                  </div>
                </div>
              </form>
              <div class="bounce-loader" style="display: none;" id="baLoader">
                <div style="background: #558b2fd9;" class="bounce1"></div>
                <div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
                <div style="background: #558b2fd9;" class="bounce3"></div>
              </div>
              <script src="'.base_url().'main-assets/js/custom.js"></script>';
      break;

      case 'account':
        $banks = '';
        foreach($_SESSION['data']['banks'] as $bank) { 
          $sel = ($_SESSION['user']->account->bank_id == $bank->id);
          if($sel) {
            $banks.='<option value="'.base64_encode($bank->id).'" selected>'.$bank->name.'</option>';
          }
          else {
            $banks.='<option value="'.base64_encode($bank->id).'">'.$bank->name.'</option>';
          }
        }
        $name = $_SESSION['user']->account->name;
        $number = $_SESSION['user']->account->number;

        return '
          <div class="overflow-hidden mb-1">
            <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Bank</strong> Details
            </h2>
          </div>
          <div class="overflow-hidden">
            <p class="mb-0">Add or update your bank account information.</p>
            <p class="mb-2"><strong class="font-weight-extra-bold" style="color: #ff0000c7">Note:</strong> We only support
              bank transfer.</p>
          </div>
          <form id="accForm" method="post" class="needs-validation" novalidate="novalidate">
            <div class="alert alert-danger alert-dismissible" id="baError" style="display: none">
            </div>
            <div class="form-row">
              <div class="form-group col" style="padding: 0;">
                <div class="col-sm-12" style="float: left;">
                  <label class="font-weight-bold text-dark text-2">Account Name <span
                      style="color: #ff0000">*</span></label>
                  <input type="text" id="baAcct" style="font-size: 1rem;" value="'.$name.'"
                    class="form-control form-control-lg" required="" placeholder="Your Account Name">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col" style="padding: 0;">
                <div class="col-sm-6" style="float: left;">
                  <label class="font-weight-bold text-dark text-2">Bank</label> <span style="color: #ff0000">*</span>
                  <select id="baBank" style="font-size: 1rem;" class="form-control form-control-lg" required>'.
                    $banks.'</select>
                </div>
                <div class="col-sm-6" style="float: left;">
                  <label class="font-weight-bold text-dark text-2">Account Number <span
                      style="color: #ff0000">*</span></label>
                  <input type="number" minlength="8" maxlength="12" pattern="[0-9]{12}" id="baNumber"
                    style="font-size: 1rem;" value="'.$number.'" class="form-control
                                   form-control-lg" required="" placeholder="Your Account Number">
                </div>
              </div>
            </div>
            <div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
              <div class="form-group">
                <input type="submit" id="baButton" value="Save" class="btn btn-primary btn-modern float-right"
                  data-loading-text="Loading...">
              </div>
            </div>
          </form>
          <div class="bounce-loader" style="display: none" id="baLoader">
            <div style="background: #558b2fd9;" class="bounce1"></div>
            <div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
            <div style="background: #558b2fd9;" class="bounce3"></div>
          </div>
          <script src="'.base_url().'main-assets/js/custom.js"></script>
        ';
      break;

      case 'withdraw': 
          if($data['tb'] == 1) {
            $view = '<p>You have already requested for <strong>Withdrawal</strong> this month</p>';
          }
          else {
            $view = '<div class="alert alert-danger alert-dismissible" id="baError" style="display: none">
            </div>
            <div class="form-row">
              <div class="form-group col" style="padding: 0;">
                <div class="col-sm-12" style="float: left;">
                  <label class="font-weight-bold text-dark text-2">Withdrawal Amount <span
                      style="color: #ff0000">*</span></label>
                  <input type="number" id="wiAmt" style="font-size: 1rem;"
                    class="form-control form-control-lg" min="1000" required="" placeholder="₦1000">
                </div>
              </div>
            </div>
            <div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
              <div class="form-group">
                <input type="submit" id="baButton" value="Withdraw" class="btn btn-primary btn-modern float-right"
                  data-loading-text="Loading...">
              </div>
            </div>';
          } 

          return '
          <div class="overflow-hidden mb-1">
            <h2 class="font-weight-normal text-7 mb-0">Withdraw</h2>
          </div>
          <div class="overflow-hidden">
            <p class="mb-0">Apply for withdrawal of your earnings.</p>
            <p class="mb-2"><strong class="font-weight-extra-bold" style="color: #ff0000c7">Note:</strong> You must earn
              at least <strong>₦1000</strong> to be eligible for withdrawal. Make sure you apply for withdrawal on or
              before <strong>25<sup>th</sup></strong> of the month.</p>
          </div>
          <form id="withForm" method="post" class="needs-validation" novalidate="novalidate">
            '.$view.'
          </form>
          <div class="bounce-loader" style="display: none" id="baLoader">
            <div style="background: #558b2fd9;" class="bounce1"></div>
            <div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
            <div style="background: #558b2fd9;" class="bounce3"></div>
          </div>
          <script src="'.base_url().'main-assets/js/custom.js"></script>
          ';
          break;

      default:
        $tb = $data['tb'];
        $mb = $data['mb'];
        $bal = $data['bal'];
        $tc = $data['tc'];
        $mc = $data['mc'];
        return '
          <div class="overflow-hidden mb-1">
            <h2 class="font-weight-normal text-7 mb-0">Dashboard</h2>
          </div>
          <div class="overflow-hidden">
            <p class="mb-0">Summary of your progress so far.</p>
          </div>
          <div id="dash">
            <div class="col-sm-6 col-lg-4" id="card-par">
              <div class="card">
                <div class="card-body"
                  id="card-body">
                  <h5 class="card-title"><i class="far fa-money-bill-alt"></i> Today</h5>
                  <h2>₦ '.$tb.'</h2>
                </div>
              </div>
            </div>
             <div class="col-sm-6 col-lg-4" style="float: left" id="card-par">
               <div class="card">
                 <div class="card-body"
                   id="card-body">
                   <h5 class="card-title"><i class="fa fa-coins"></i> '.date('F').'</h5>
                   <h2>₦ '.$mb.'</h2>
                 </div>
               </div>
             </div>
             <div class="col-sm-6 col-lg-4" style="float: left" id="card-par">
               <div class="card">
                 <div class="card-body" 
                   id="card-body">
                   <h5 class="card-title"><i class="fa fa-wallet"></i> Total Balance</h5>
                   <h2>₦ '.$bal.'</h2>
                 </div>
               </div>
             </div>
             <div class="col-sm-6 col-lg-4" style="float: left" id="card-par">
               <div class="card">
                 <div class="card-body"
                   id="card-body">
                   <h5 class="card-title"><i class="far fa-hand-pointer"></i> Today\'s Clicks</h5>
                   <h2>'.$tc.'</h2>
                 </div>
               </div>
             </div>
             <div class="col-sm-6 col-lg-4" style="float: left" id="card-par">
               <div class="card">
                 <div class="card-body"
                   id="card-body">
                   <h5 class="card-title"><i class="fas fa-hand-point-up"></i> '.date('F').'\'s Clicks</h5>
                   <h2>'.$mc.'</h2>
                 </div>
               </div>
             </div>
          </div>
          <script src="'.base_url().'main-assets/js/custom.js"></script>
        ';
        break;
    }
  }
  
}