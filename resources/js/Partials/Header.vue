  <template>
    <nav id="nav-bar" class="sticky-top">
    <div class="menu container  d-flex align-items-center justify-content-between">
      <a href="#logo-color">
        <img id="logo-color" src="template/assets/logo-text.png" width="auto" height="50" alt="">
        <img id="logo-white" src="template/assets/logo-text-white.png" width="auto" height="50" alt="">
      </a>
      <div id="nav-bar-menu" class="d-flex align-items-center">
        <div><a href="#"><i class="far fa-building me-2"></i><span>Hotel</span></a></div>
        <div><a href="#"><i class="fas fa-road me-2"></i><span>Tour</span></a></div>
      </div>
      <div class="sign-in">
        <p>Sign In</p>
      </div>
    </div>
  </nav>

    <header>
    <section class="booking-section">
      <div class="d-flex justify-content-center flex-wrap">
        <div class="booking-container">
          <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="hotel-tab" data-bs-toggle="tab" data-bs-target="#hotel" type="button"
                role="tab" aria-controls="hotel" aria-selected="false">
                <i class="far fa-building me-2"></i><span>Hotel</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tour-tab" data-bs-toggle="tab" data-bs-target="#tour" type="button"
                role="tab" aria-controls="tour" aria-selected="false">
                <i class="fas fa-road me-2"></i><span>Tour</span>
              </button>
            </li>
          </ul>
          <div class="tab-content-wrapper">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                <!-- hotel booking details start -->
                <div class="booking-wrapper d-flex justify-content-between">

                  <div class="booking-details">
                    <h5>CITY/HOTEL/RESORT/AREA</h5>
                    <select class="form-control js-example-tags">
                      <option selected="selected">Dhaka</option>
                      <option>Cox's Bazar</option>
                      <option>Chittagong</option>
                      <option>Rajshahi</option>
                      <option>Khulna</option>
                      <option>Barishal</option>
                      <option>Syllhet</option>
                    </select>
                  </div>
                  <div class="d-flex">
                    <div class="booking-details me-2" >
                      <h5>CHECK IN</h5>
                      <h4 id="result-1">13 Oct,21</h4>
                      <input autocomplete="off" type="text" placeholder="Select check in date" id="check-in" />
                    </div>
                    <div class="booking-details" >
                      <h5>CHECK OUT</h5>
                      <h4 id="result-2">14 Oct,21</h4>
                      <input autocomplete="off" type="text" placeholder="Select check out date" id="check-out" />
                    </div>
                  </div>
                  <div class="booking-details">
                    <div onclick="handleBooking()" id="roomsAndGuest">
                      <h5>GUESTS</h5>
                      <h4>Guests</h4>
                      <p><span id="adultTotal">6</span> Adults, <span id="childTotal">4</span> Children</p>
                    </div>
                  </div>
                  <div id="bookingRooms">
                    <div class="d-flex align-items-center justify-content-between">
                      <div>
                        <h5>Adult</h5>
                        <p>12 Years+</p>
                      </div>
                      <div>
                        <i onclick="decrement1()" class="fas fa-minus"></i><span id="adult">0</span><i
                          onclick="increment1()" class="fas fa-plus"></i>
                      </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-center justify-content-between">
                      <div>
                        <h5>Child</h5>
                        <p>0-12 Years</p>
                      </div>
                      <div>
                        <i onclick="decrement2()" class="fas fa-minus"></i><span id="child">0</span><i
                          onclick="increment2()" class="fas fa-plus"></i>
                      </div>
                    </div>
                    <hr />
                    <div class="d-flex align-items-center justify-content-end pb-2">
                      <div onclick="done()" class="done-btn">
                        Done
                      </div>
                    </div>
                  </div>
                </div>

                <!-- hotel booking details end -->
              </div>
              <div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                <div class="location">
                  <div class="booking-wrapper">
                    <div class="booking-details">
                      <h5>LOCATION</h5>
                      <select class="form-control js-example-tags">
                        <option selected="selected">Dhaka</option>
                        <option>Cox's Bazar</option>
                        <option>Chittagong</option>
                        <option>Rajshahi</option>
                        <option>Khulna</option>
                        <option>Barishal</option>
                        <option>Syllhet</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <input type="submit" class="search" value="Search" name="Search" />
      </div>
    </section>
  </header>
  </template>
