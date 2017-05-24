<div class="col-sm-3 "> 
  <div class="nav-side-menu">
      <div class="brand">
        
        <div>{{ Auth::user()->name }}</div>
      </div>
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
              <ul id="menu-content" class="menu-content collapse out">

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="#"><i class="fa fa-home fa-lg"></i> Administrar</a> 
                  </li>

                  <li data-toggle="collapse" data-target="#citas" class="collapsed">
                    <a href="#"><i class="fa fa-calendar fa-lg"></i> Calendario</a>
                  </li>
             
              </ul>
            </div>
        </div>
</div>