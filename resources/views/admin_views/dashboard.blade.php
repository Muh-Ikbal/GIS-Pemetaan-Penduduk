@extends('admin_views.template.app')
@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
            <div class="card">
              <span class="mask bg-primary opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row">
                  <div class="col-8 text-start">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                      <svg class="mt-2" fill="#000000" width="32px" height="32px" viewBox="0 0 32 32"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path
                            d="M30,25.11H29v-.89a2,2,0,0,0-2-2H26V14.11h1a2,2,0,0,0,2-2v-.89h2a1,1,0,0,0,.43-1.9l-15-7.22a1,1,0,0,0-.86,0L.57,9.32A1,1,0,0,0,1,11.22H3v.89a2,2,0,0,0,2,2H6v8.11H5a2,2,0,0,0-2,2v.89H2a2,2,0,0,0-2,2V29a1,1,0,0,0,1,1H31a1,1,0,0,0,1-1V27.11A2,2,0,0,0,30,25.11Zm-14-21L26.62,9.22H5.38Zm-11,8v-.89H27v.89H5Zm19,2v8.11H21.5V14.11Zm-4.5,0v8.11H17V14.11Zm-4.5,0v8.11H12.5V14.11Zm-4.5,0v8.11H8V14.11ZM5,24.22H27v.89H5ZM30,28H2v-.89H30Z">
                          </path>
                        </g>
                      </svg>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ $kecamatanCount }}
                    </h5>
                    <span class="text-white text-sm">Jumlah Kecamatan</span>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 mt-4 mt-md-0">
            <div class="card">
              <span class="mask bg-dark opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row">
                  <div class="col-8 text-start">
                    <div
                      class="icon icon-shape flex justify-center align-center bg-white shadow text-center border-radius-2xl">
                      <svg class="mt-2" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 256 256"
                        enable-background="new 0 0 256 256" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path
                            d="M192.498,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S183.22,124.8,192.498,124.8z M171.798,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S162.52,166.6,171.798,166.6z M144.998,203.3h-18.9h-18.9c-11.5,0-18.7,9.5-18.7,21.4V254h12.9v-25.9c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8 c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9v-29.1C163.998,212.8,156.698,203.3,144.998,203.3z M149.698,124.8 c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8S140.42,124.8,149.698,124.8z M199.098,183.4 c0,9.3,7.5,16.8,16.8,16.8s16.8-7.5,16.8-16.8s-7.5-16.8-16.8-16.8S199.098,174.1,199.098,183.4z M197.398,203.3 c-11.5,0-18.7,9.5-18.7,21.4V254h12.9v-25.9c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9 v-29.1c0.2-12.1-7.1-21.6-18.7-21.6h-18.9h-19V203.3z M39.798,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8 s-16.8-7.522-16.8-16.8S30.52,166.6,39.798,166.6z M14.798,253.9v-25.8c0-1.2,1-2,2-2c1.2,0,2,0.8,2,2v25.8h41.5v-25.8 c0-1.2,1-2,2-2c1.2,0,2,1,2,2v25.8h12.9v-29.1c0.2-12.1-7.1-21.6-18.7-21.6h-18.9h-18.9c-11.5,0-18.7,9.5-18.7,21.4v29.3 L14.798,253.9L14.798,253.9z M109.298,183.4c0,9.3,7.5,16.8,16.8,16.8c9.3,0,16.8-7.5,16.8-16.8s-7.5-16.8-16.8-16.8 S109.298,174.1,109.298,183.4z M61.298,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8 S52.02,124.8,61.298,124.8z M106.698,124.8c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8 S97.42,124.8,106.698,124.8z M84.098,166.6c9.278,0,16.8,7.522,16.8,16.8s-7.522,16.8-16.8,16.8s-16.8-7.522-16.8-16.8 S74.82,166.6,84.098,166.6z M128,2C99.327,2,76,25.327,76,54s23.327,52,52,52s52-23.327,52-52S156.673,2,128,2z M166.457,34.067 h-14.072c-1.158-5.359-2.784-10.311-4.845-14.62c-0.974-2.036-2.028-3.883-3.148-5.55C153.912,17.802,161.738,24.999,166.457,34.067 z M171.333,54c0,4.212-0.615,8.281-1.741,12.133h-15.889c0.484-3.924,0.736-7.992,0.736-12.133c0-3.838-0.22-7.611-0.636-11.267 h16.035C170.808,46.328,171.333,50.103,171.333,54z M128,95.889c-5.758,0-11.964-8.072-15.305-21.089h30.61 C139.964,87.817,133.758,95.889,128,95.889z M111.027,66.133c-0.511-3.787-0.8-7.844-0.8-12.133c0-3.963,0.244-7.73,0.684-11.267 h34.178c0.44,3.537,0.684,7.304,0.684,11.267c0,4.29-0.288,8.347-0.8,12.133H111.027z M84.667,54c0-3.897,0.525-7.672,1.495-11.267 h16.035c-0.417,3.656-0.636,7.429-0.636,11.267c0,4.142,0.252,8.209,0.736,12.133H86.408C85.282,62.281,84.667,58.212,84.667,54z M128,12.111c5.884,0,12.233,8.434,15.517,21.955h-31.034C115.767,20.546,122.116,12.111,128,12.111z M111.607,13.896 c-1.12,1.667-2.174,3.515-3.148,5.55c-2.061,4.309-3.687,9.261-4.845,14.62H89.543C94.262,24.999,102.088,17.802,111.607,13.896z M89.997,74.8H103.8c1.144,5.028,2.71,9.676,4.66,13.753c0.974,2.036,2.028,3.883,3.148,5.55 C102.392,90.323,94.757,83.461,89.997,74.8z M144.393,94.104c1.12-1.667,2.174-3.515,3.148-5.55c1.95-4.077,3.516-8.725,4.66-13.753 h13.802C161.243,83.461,153.608,90.323,144.393,94.104z">
                          </path>
                        </g>
                      </svg>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ round($avgPenduduk, 2) }}
                    </h5>
                    <span class="text-white text-sm">Rata-Rata Jumlah Penduduk Terbaru</span>
                  </div>
                  <div class="col-4">

                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">Tahun {{ $maxTahun }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12">
            <div class="card">
              <span class="mask bg-dark opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row">
                  <div class="col-8 text-start">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                      <svg class="mt-2" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path
                            d="M14 16H17.8C18.9201 16 19.4802 16 19.908 15.782C20.2843 15.5903 20.5903 15.2843 20.782 14.908C21 14.4802 21 13.9201 21 12.8V6.2C21 5.0799 21 4.51984 20.782 4.09202C20.5903 3.71569 20.2843 3.40973 19.908 3.21799C19.4802 3 18.9201 3 17.8 3H9.2C8.07989 3 7.51984 3 7.09202 3.21799C6.71569 3.40973 6.40973 3.71569 6.21799 4.09202C6.01338 4.49359 6.00082 5.01165 6.00005 6M18 6L13 11L10 8M18 6V9M18 6H15M9 12C9 13.1046 8.10457 14 7 14C5.89543 14 5 13.1046 5 12C5 10.8954 5.89543 10 7 10C8.10457 10 9 10.8954 9 12ZM7 17C7.92997 17 8.39496 17 8.77646 17.1022C9.81173 17.3796 10.6204 18.1883 10.8978 19.2235C11 19.605 11 20.07 11 21H3C3 20.07 3 19.605 3.10222 19.2235C3.37962 18.1883 4.18827 17.3796 5.22354 17.1022C5.60504 17 6.07003 17 7 17Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </svg>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ round($avgKepadatan, 2) }} KM<sup>2</sup>
                    </h5>
                    <span class="text-white text-sm">Rata-Rata Laju Kepadatan Penduduk</span>
                  </div>
                  <div class="col-4">
                    <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">Tahun {{ $maxTahun }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row mt-4">

        </div>
      </div>

    </div>
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card z-index-2">
          <div class="card-body p-3">
            <div class="chart" style="width: 100%; max-width: 1280px; height: 600px; margin: auto;">
              <canvas class="chart-canvas" id="chartPenduduk"></canvas>
            </div>
          </div>
        </div>

      </div>


    </div>

  </div>
@endsection
