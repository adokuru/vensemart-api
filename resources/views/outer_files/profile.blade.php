@extends('nk1/layouts/nk5layout')

@section('content')

<div class="container-fluid mt-5">
                        <div class="nk-content-inner mt-5">
                            <div class="nk-content-body">

                            <div class="nk-block nk-block-lg">
                                
            
                                        <div class="card card-preview">
                                            
                                            <div class="card-inner">
                                                
                                                 
                                                <div class="row g-gs">

                                                  
                                                    <div class="col-md-8">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tabItem13">
                                                            
                                                <!-- .nk-block-head -->
                                                            <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Basics</h6>
                                                        </div>

                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Display Name </span>
                                                                <span class="data-value"> {{ auth()->user()->first_name}} 
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->

                                                       

                                                        <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Email</span>
                                                                <span class="data-value">{{  auth()->user()->email }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                                        </div><!-- data-item -->


                                                       

                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Address</span>
                                                                <span class="data-value">{{  auth()->user()->address }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->

                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Bank</span>
                                                                <span class="data-value">{{  auth()->user()->bank_nm }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->
                                                        



                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Phone Number</span>
                                                                <span class="data-value text-soft">{{  auth()->user()->telephone }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div><!-- data-item -->
                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Date of Birth</span>
                                                                <span class="data-value">29 Feb, 1986</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div>data-item -->
                                                        <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                            <div class="data-col">
                                                                <span class="data-label">Address</span>
                                                                <span class="data-value">2337 Kildeer Drive,<br>Kentucky, Canada</span>
                                                            </div>
                                                            <div class="data-col data-col-end"></div>
                                                        </div>data-item -->
                                                    </div><!-- data-list -->
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Preferences</h6>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Language</span>
                                                                <span class="data-value">English (United State)</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change Language</a></div>
                                                        </div><!-- data-item -->
                                                        <!-- <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Date Format</span>
                                                                <span class="data-value">M d, YYYY</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                                        </div>data-item -->
                                                        <!-- <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Timezone</span>
                                                                <span class="data-value">Bangladesh (GMT +6)</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                                        </div>data-item -->
                                                    </div><!-- data-list -->
                                                </div><!-- .nk-block -->
                                                            </div>
                                                            <div class="tab-pane" id="tabItem14">
                                                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
                                                                <p>Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur.</p>
                                                            </div>
                                                            <div class="tab-pane" id="tabItem15">
                                                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                                                <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                                                            </div>
                                                            <div class="tab-pane" id="tabItem16">
                                                                <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                                                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                
                            </div>
                        </div>
                    </div>

                    @endsection