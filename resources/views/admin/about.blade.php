 @extends('layouts.app')
 @section('content')
   <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h2 class="content-header-title">1 Column</h2>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Page Layouts</a>
                </li>
                <li class="breadcrumb-item active">1 Column
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Description -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Description</h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <p>1 Column layout is very useful for full width page requirements i.e: Contact us, Terms & Condition, Privacy policy etc..., It has Navbar with back to dashboard/home page option and footer, navigation menu will not be displayed on this layout.</p>
            </div>
        </div>
    </div>
</div>
<!--/ Description -->
<!-- CSS Classes -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">CSS Classes</h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <p>This table contains all classes related to the 1 column layout. This is a custom layout for full width page requirements.</p>
                <p>All these options can be set via following classes:</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Classes</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><code>.1-column</code></th>
                                <td>You can create 1 column layout by adding <code>.1-column</code> class in <code>&lt;body&gt;</code> tag.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ CSS Classes -->
<!-- HTML Markup -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">HTML Markup</h4>
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                <li><a data-action="close"><i class="icon-cross2"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <p>This section contains HTML Markup to create 1 column layout. You need to add the <code>.1-column</code> class in the <code>&lt;body&gt;</code> tag as show in below markup on line no 4. Please note that 1 column layout do not have Navigation section and it has back to Dashboard or Home page link in Navbar.</p>
                <p>Robust has a ready to use starter kit, you can use this layout directly by using the starter kit pages from the <code>robust-admin/starter-kit</code> folder.</p>
                <pre data-line="4" class="language-markup">
        <code class="language-markup">
            &lt;!DOCTYPE html&gt;
              &lt;html lang="en"&gt;
                &lt;head&gt;&lt;/head&gt;
                &lt;body data-menu="vertical-menu" class="vertical-layout vertical-menu 1-column menu-expanded"&gt;

                  &lt;!-- navbar-fixed-top--&gt;
                  &lt;nav role="navigation" class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark navbar-shadow navbar-border"&gt;
                    .....
                  &lt;/nav&gt;

                  &lt;!-- BEGIN Content--&gt;
                  &lt;div class="content app-content container-fluid"&gt;
                    .....
                  &lt;/div&gt;
                  &lt;!-- END Content--&gt;


                  &lt;!-- START FOOTER DARK--&gt;
                  &lt;footer class="footer footer-dark"&gt;
                    .....
                  &lt;/footer&gt;
                  &lt;!-- START FOOTER DARK--&gt;

                &lt;/body&gt;
              &lt;/html&gt;
        </code>
        </pre>
            </div>
        </div>
    </div>
</div>
<!--/ HTML Markup -->

        </div>
      </div>
    </div>
@endsection