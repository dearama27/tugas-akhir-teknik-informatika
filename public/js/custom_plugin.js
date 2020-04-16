
jQuery.fn.extend({

    laradata: function (option = {
        buttons: [],
        columns: [],
    }) {

        let btnItems = '';
        if (option.buttons.length > 0) {
            option.buttons.forEach(item => {
                btnItems += `
          <a href="${item.link}" class="btn btn-primary btn-sm float-left">
            <i class="${item.icon}"></i> ${item.text}
          </a>
          `;
            })
        }

        columnItems = '';

        if (option.columns > 0) {
            option.columns.forEach(item => {
                columnItems += `
          <th style="${item.style}">${item.data}</th>
          `;
            })
        }

        let data = `
    <div class="card">
      <div class="card-header">
          <div class="btn-group">
              ${btnItems}
          </div>
          <!-- SEARCH FORM -->
          <form class="form-inline ml-3 float-right">
              <div class="input-group input-group-sm">
                  <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
                      type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-navbar" style="background-color: #f2f4f6" type="submit">
                          <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>
          </form>
          <div class="clearfix"></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
          <table class="table table-striped">
  
              <thead>
                  <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Perusahaan</th>
                      <th>Total Invoice</th>
                      <th>Inv. Unpaid</th>
                      <th style="width: 100px">Action</th>
                  </tr>
              </thead>
  
              <tbody>
                  <tr>
                      <td>1</td>
                      <td>Prioritas Group</td>
                      <td>
                          <div class="progress progress-xs">
                              <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                          </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                      <td>
                        <div class="dropdown dropleft">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Opsi
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Detail</a>
                            </div>
                        </div>
                      </td>
                  </tr>
  
              </tbody>
          </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
      </div>
      <!-- /.card-footer -->
  </div> `;

    $.get('')
    this.append(data);

    }
})