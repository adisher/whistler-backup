<div class="row d-flex">
    <!-- Left Container -->
    <div class="col-md-4 border shadow">
        <div class="pt-2">
            <div class="accordion" id="accordion">
                <div class="card no-shadow mt-3 p-3">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="mb-0">Yield Details</h5>
                        <input type="checkbox" id="shiftDetails" class="ml-auto check-size" />
                    </div>
                </div>
                <hr />
                <div class="card no-shadow">
                    <button class="btn btn-link float-right d-inline-block" type="button" id="fleetno"
                        data-toggle="collapse" data-target="#fleetCollapse" aria-expanded="false"
                        aria-controls="fleetCollapse">
                        <div class="card-header d-flex align-items-center" id="fleetHeading">
                            <h5 class="mb-0">Fleet</h5>
                            <i class="fas fa-chevron-up ml-auto"></i>
                        </div>
                    </button>
                    <div id="fleetCollapse" class="collapse" aria-labelledby="fleetHeading" data-parent="#accordion">
                        <div class="card-body">
                            <!-- Search bar -->
                            <input class="form-control" id="searchInput" type="text" placeholder="Search..."
                                aria-label="Search">
                            <!-- List data -->
                            <ul class="list-group mt-3" id="fleetnolist">
                                {{-- List goes here --}}
                            </ul>

                            <div class="card mt-3">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="mb-0">Rental History</h5>
                                    <input type="checkbox" id="rental" class="ml-auto check-size" />
                                </div>
                            </div>

                            {{-- <div class="card mt-3">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="mb-0">Shift Details</h5>
                                    <input type="checkbox" id="shiftDetails" class="ml-auto check-size" />
                                </div>
                            </div> --}}

                            <div class="card mt-3">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="mb-0">Deployment History</h5>
                                    <input type="checkbox" id="deploymentToggle" class="ml-auto check-size" />
                                </div>

                                <!-- Wrapped the card body inside a div with an id -->
                                <div id="deploymentMenu" style="display: none;">
                                    <div class="card-body">
                                        <!-- Submenu for Sites -->
                                        <div class="card mt-3">
                                            <div class="card-header">Site</div>
                                            <div class="card-body">
                                                <select class="form-control" name="sites[]" id="siteList"
                                                    multiple="multiple">
                                                    <!-- Option data for sites -->
                                                    <option>Select Site</option>
                                                    {{-- Sites goes here --}}
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Submenu for Shifts -->
                                        <div class="card mt-3">
                                            <div class="card-header">Shifts</div>
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="morningShift">
                                                    <label class="form-check-label" for="morningShift">Morning</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        id="eveningShift">
                                                    <label class="form-check-label" for="eveningShift">Evening</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card mt-3">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="mb-0">Maintenance</h5>
                                    <input type="checkbox" id="maintenanceToggle" class="ml-auto check-size" />
                                </div>
                                <div id="maintenanceMenu" style="display: none;">
                                    <div class="card-body">
                                        <!-- Submenu for Corrective Maintenance -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="correctiveMaintenance" id="correctiveMaintenance">
                                            <label class="form-check-label" for="correctiveMaintenance">
                                                Corrective Maintenance
                                            </label>
                                        </div>
                                        <!-- Submenu for Preventive Maintenance -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="preventiveMaintenance" id="preventiveMaintenance">
                                            <label class="form-check-label" for="preventiveMaintenance">
                                                Preventive Maintenance
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <hr />
                <div class="card no-shadow">
                    <button class="btn btn-link float-right d-inline-block" type="button" id="partsCost"
                        data-toggle="collapse" data-target="#partsCollapse" aria-expanded="false"
                        aria-controls="partsCollapse">
                        <div class="card-header d-flex align-items-center" id="partsHeading">
                            <h5 class="mb-0">Parts</h5>
                            <i class="fas fa-chevron-up ml-auto"></i>
                        </div>
                    </button>
                    <div id="partsCollapse" class="collapse" aria-labelledby="partsHeading"
                        data-parent="#accordion">
                        <div class="card-body">
                            <!-- Search bar -->
                            <input class="form-control" id="searchparts" type="text" placeholder="Search..."
                                aria-label="Search">
                            <!-- List data -->
                            <ul class="list-group mt-3" id="partslist">
                                {{-- List goes here --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="card no-shadow">
                    <button class="btn btn-link float-right d-inline-block" type="button" id="fuelCost"
                        data-toggle="collapse" data-target="#fuelCollapse" aria-expanded="false"
                        aria-controls="fuelCollapse">
                        <div class="card-header d-flex align-items-center" id="fuelHeading">
                            <h5 class="mb-0">Fuel</h5>
                            <i class="fas fa-chevron-up ml-auto"></i>
                        </div>
                    </button>
                    <div id="fuelCollapse" class="collapse" aria-labelledby="fuelHeading" data-parent="#accordion">
                        <div class="card-body">
                            <!-- Search bar -->
                            <input class="form-control" id="searchfuel" type="text" placeholder="Search..."
                                aria-label="Search">
                            <!-- List data -->
                            <ul class="list-group mt-3" id="fuellist">
                                {{-- List goes here --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Move buttons -->
    <div class="col-md-3">
        <!-- Buttons -->
        <div class="d-flex flex-column align-items-center justify-content-center h-100">
            <span class="btn btn-primary mb-2 disabled" id="moveAllLeftButton">
                <i class="fas fa-backward"></i>
            </span>
            <span class="btn btn-primary mb-5 disabled" id="moveLeftButton">
                <i class="fas fa-caret-left"></i>
            </span>
            <span class="btn btn-primary mb-2 disabled" id="moveRightButton">
                <i class="fas fa-caret-right"></i>
            </span>
            <span class="btn btn-primary mb-2 disabled" id="moveAllRightButton">
                <i class="fas fa-forward"></i>
            </span>
        </div>
    </div>
    <!-- Right Container -->
    <div class="col-md-4 border shadow">
        <div class="d-flex align-items-center px-2 pt-2">
            <h6 class="ml-auto" id="asset_count">Selected Assets: 0</h6>
        </div>
        <hr />
        <div class="card mt-1 no-shadow">
            <!-- List data -->
            <!-- Search bar -->
            <input class="form-control mb-2" id="searchRightList" type="text" placeholder="Search..."
                aria-label="Search">
            <ul class="list-group p-3" id="rightContainerList">
                {{-- List goes here --}}
            </ul>
        </div>
    </div>
</div>
