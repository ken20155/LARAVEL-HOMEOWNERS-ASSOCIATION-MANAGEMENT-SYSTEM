
<div class="w-full overflow-hidden rounded-lg shadow-xs bg-white">
  <div class="w-full overflow-x-auto">
    <div class="row" id="div_laravel_datatable">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header px-4 py-4">
                    <h4 class="card-title">
                        {{-- <button type="button" class="btn btn-sm btn-primary" id="addNewAccount">Add New</button> 
                          <button type="button" class="btn btn-sm btn-info" id="refrest-datatable">Refresh</button>
                        --}}
                        <button id="addNewAccount" type="button"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                      >
                      Add New
                      </button>
                      <button id="refrest-datatable" type="button"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                      >
                      Refresh
                      </button>
                    </h4>
                      <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <label class="block mt-2 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">
                            LTO's
                          </span>
                          <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          >
                            <option>LTO 1</option>
                            <option>LTO 2</option>
                            <option>LTO 3</option>
                            <option>LTO 4</option>
                          </select>
                        </label>

                        <label class="block mt-2 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">FROM</span>
                          <!-- focus-within sets the color for the icon when input is focused -->
                          <div
                            class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                          >
                            <input
                              class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                              placeholder="Jane Doe"
                              type="date"
                            />
                            <div
                              class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                            </div>
                          </div>
                        </label>
                        <label class="block mt-2 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">TO</span>
                          <!-- focus-within sets the color for the icon when input is focused -->
                          <div
                            class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                          >
                            <input
                              class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                              placeholder="Jane Doe"
                              type="date"
                            />
                            <div
                              class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                            </div>
                          </div>
                        </label>


                      </div>
                </div>
                <div class="card-body px-2 py-2">
                    <div class="table-responsive">
                        <div >
                            <table class="table table-bordered w-full whitespace-no-wrap" id="laravel_datatable">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>





<!-- Modal -->
{{-- <form action="" method="post" id="submit-form">
  <div class="modal fade" id="modal-view" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"><?= $title ?> - <span id="action-text"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">

        </div>
        <div class="modal-footer">
          <div id="footer-custom"></div>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>
 --}}

