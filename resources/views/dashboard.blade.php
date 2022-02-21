<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main>
        <!-- Main dashboard content-->
        <div class="container-xl p-5">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col flex-shrink-0 mb-5 mb-md-0">
                    <h1 class="display-4 mb-0">Statistics</h1>
                    <div class="text-muted">Ticket and User overview</div>
                </div>
            </div>

            <!-- Colored status cards-->
            <div class="row gx-5">
                <div class="col-xxl-3 col-md-6 mb-5">
                    <div class="card card-raised bg-gray text-white">
                        <div class="card-body px-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="me-2">
                                    <div class="card-text">Total Users</div>
                                    <div class="display-5 text-white">1</div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6 mb-5">
                    <div class="card card-raised bg-success text-white">
                        <div class="card-body px-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="me-2">
                                    <div class="card-text">Total Tickets</div>
                                    <div class="display-5 text-white">1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6 mb-5">
                    <div class="card card-raised bg-danger text-white">
                        <div class="card-body px-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="me-2">
                                    <div class="card-text">Open Tickets</div>
                                    <div class="display-5 text-white">1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6 mb-5">
                    <div class="card card-raised bg-warning text-white">
                        <div class="card-body px-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="me-2">
                                    <div class="card-text">In Progress Tickets</div>
                                    <div class="display-5 text-white">1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status pie chart example-->
                <div class="col-lg-4 mb-5">
                    <div class="card card-raised h-100">
                        <div class="card-header bg-primary text-white px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-4">
                                    <h2 class="card-title text-white mb-0">Category Breakdown</h2>
                                    <div class="card-subtitle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex h-100 w-100 align-items-center justify-content-center">
                                <div class="w-100" style="max-width: 20rem"><canvas id="myCategoryPieChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status pie chart example-->
                <div class="col-lg-4 mb-5">
                    <div class="card card-raised h-100">
                        <div class="card-header bg-primary text-white px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-4">
                                    <h2 class="card-title text-white mb-0">Priority Breakdown</h2>
                                    <div class="card-subtitle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex h-100 w-100 align-items-center justify-content-center">
                                <div class="w-100" style="max-width: 20rem"><canvas id="myPriorityPieChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status pie chart example-->
                <div class="col-lg-4 mb-5">
                    <div class="card card-raised h-100">
                        <div class="card-header bg-primary text-white px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-4">
                                    <h2 class="card-title text-white mb-0">Status Breakdown</h2>
                                    <div class="card-subtitle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex h-100 w-100 align-items-center justify-content-center">
                                <div class="w-100" style="max-width: 20rem"><canvas id="myStatusPieChart"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
