@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="float-left">
                Mening boshqaruv panelim
              </h3>
              <div class="float-right">
                <a href="#profileEditModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-edit"></i> Tahrirlash</a>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div>
                <p>
                  Salom {{ $user->name }}
                </p>
                <p>
                  Bu sizning boshqaruv panelingiz
                </p>
              </div>
            

              <!-- Profile Edit Modal -->
              <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Profilingizni tahrirlang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Ism/label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ismingizni kiriting">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Familiya</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Familiyani kiriting">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">E-pochta manzili</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Elektron pochtani kiriting">

                              </div>
                              <div class="col-md-6">                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Foydalanuvchi nomi</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Foydalanuvchi nomi">
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Haqida</label>
                                <textarea class="form-control" rows="5"></textarea>
                              </div>
                            </div>
                          </div>
                          
                          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Ma'lumotni saqlash</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                      <button type="button" class="btn btn-primary">O'zgarishlarni saqlang</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')
          </div>

      </div>
    </div>
  </div>

</div>
@endsection