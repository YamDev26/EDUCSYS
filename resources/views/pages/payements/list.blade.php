@extends('app')
@section('title', 'list payement')
@section('content')
<div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom justify-content-between d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control ps-4" placeholder="Search Here...">
                                        <i
                                            class="ti ti-search position-absolute top-50 translate-middle-y start-0 ms-2"></i>
                                    </div>
                                </div>

                                <a href="apps-invoice-create.html" class="btn btn-primary"><i
                                    class="ti ti-plus me-1"></i>Add Invoice</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-light-subtle">
                                            <tr>
                                                <th class="ps-3 py-1" style="width: 50px;">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                                </th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Invoice ID</th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Category </th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Created On</th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Invoice To</th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Amount</th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Due Date</th>
                                                <th class="fs-12 text-uppercase text-muted py-1">Status</th>
                                                <th class="text-center  py-1 fs-12 text-uppercase text-muted"
                                                    style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <!-- end table-head -->

                                        <tbody>
                                            <tr>
                                                <td class="ps-3">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                </td>
                                                <td><span class="fw-semibold"><a href="apps-invoice-details.html" class="text-reset">#WA-2026</a></span></td>
                                                <td>Fashion</td>
                                                <td><span class="text-muted">12 Apr 2024</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar-sm">
                                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                                class="img-fluid rounded-circle">
                                                        </div>
                                                        <h6 class="fs-14 mb-0">Raul Villa</h6>
                                                    </div>
                                                </td>
                                                <td>$42,430</td>
                                                <td><span class="text-muted">12 Apr 2024</span></td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success fs-12 p-1">Paid</span>
                                                </td>
                                                <td class="pe-3">
                                                    <div class="hstack gap-1 justify-content-end">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-eye"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-edit fs-16"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr><!-- end table-row -->
                                            <tr>
                                                <td class="ps-3">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3">
                                                </td>
                                                <td><span class="fw-semibold"><a href="apps-invoice-details.html" class="text-reset">#WA-2025</a></span></td>
                                                <td>Electronics</td>
                                                <td><span class="text-muted">14 Apr 2024</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar-sm">
                                                            <img src="assets/images/users/avatar-3.jpg" alt=""
                                                                class="img-fluid rounded-circle">
                                                        </div>
                                                        <h6 class="fs-14 mb-0">Fae Sims</h6>
                                                    </div>
                                                </td>
                                                <td>$416</td>
                                                <td><span class="text-muted">24 Apr 2024</span></td>
                                                <td>
                                                    <span
                                                        class="badge bg-warning-subtle text-warning fs-12 p-1">Overdue</span>
                                                </td>
                                                <td class="pe-3">
                                                    <div class="hstack gap-1 justify-content-end">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-eye"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-edit fs-16"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i
                                                                class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><!-- end table -->
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <ul class="pagination mb-0 justify-content-center">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link"><i class="ti ti-chevrons-left"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="ti ti-chevrons-right"></i></a>
                                        </li>
                                    </ul><!-- end pagination -->
                                </div><!-- end flex -->
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

            </div>
@endsection