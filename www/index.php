<?php

// prerequisites
require( '../config.php' );

if( !( $db = mysql_pconnect( $dbhost, $dbuser, $dbpass ) ) )
    die( "DB error: " . mysql_error() . "\n\n" );
  
if( !( mysql_select_db( $dbname ) ) )
    die( "Could not select MySQL database: " . mysql_error() . "\n\n" );

// do we have a form submission?

if( isset( $_GET['year'] ) )
{
    $year = trim( $_GET['year'] );
    if( !in_array( $year, array( 2010, 2011, 2012, 'all' ) ) )
        $year = 2012;
}

if( isset( $_GET['county'] ) )
{
    $county = trim( $_GET['county'] );
    if( !in_array( $county, array( 'CARLOW', 'CAVAN', 'CLARE', 'CORK', 'DONEGAL', 'DUBLIN', 'GALWAY', 
                    'KERRY', 'KILDARE', 'KILKENNY', 'LAOIS', 'LEITRIM', 'LIMERICK', 'LONGFORD', 
                    'LOUTH', 'MAYO', 'MEATH', 'MONAGHAN', 'OFFALY', 'ROSCOMMON', 'SLIGO', 
                    'TIPPERARY', 'WATERFORD', 'WESTMEATH', 'WEXFORD', 'WICKLOW' ) ) )
        $county = 'CARLOW';
}

if( isset( $year ) && isset( $county ) )
{
    $query = "SELECT * FROM ppr WHERE county = '{$county}' ";

    if( $year != 'all' )
        $query .= "AND datesold >= '{$year}-01-01' AND datesold <= '{$year}-12-31' ";

    $query .= "ORDER BY datesold ASC";

    $results = mysql_query( $query );
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Residential Property Price Register - Remix by Open Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Open Source Solutions Limited <http://www.opensolutions.ie/>">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="css/chosen.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">Residential Property Price Register</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a class="active" href="http://www.opensolutions.ie/">Remixed by Open Solutions</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">


    <div class="row-fluid">
        <div class="span12">
            <form class="form-inline" method="GET" action="index.php">
                <label for="year"><strong>Year:&nbsp;&nbsp;</strong></label>
                <select name="year" id="year">
                    <option value="all" <?php if( !isset( $year ) || $year == 'all' ){ echo "selected=\"selected\""; } ?>>All years</option>
                    <?php for( $y = 2010; $y <= 2012; $y++ ) { ?>
                        <option value="<?= $y ?>" <?php if( isset( $year ) && $year == $y ){ echo "selected=\"selected\""; } ?>><?= $y ?></option>
                    <?php } ?>
                </select>
                <label for="county"><strong>&nbsp;&nbsp;&nbsp;&nbsp;County:&nbsp;&nbsp;</strong></label>
                <select name="county" id="county">
                    <option value="CARLOW" <?php if( isset( $county ) && $county == "CARLOW" ) { echo 'selected="selected"'; } ?>>CARLOW</option>
                    <option value="CAVAN" <?php if( isset( $county ) && $county == "CAVAN" ) { echo 'selected="selected"'; } ?>>CAVAN</option>
                    <option value="CLARE" <?php if( isset( $county ) && $county == "CLARE" ) { echo 'selected="selected"'; } ?>>CLARE</option>
                    <option value="CORK" <?php if( isset( $county ) && $county == "CORK" ) { echo 'selected="selected"'; } ?>>CORK</option>
                    <option value="DONEGAL" <?php if( isset( $county ) && $county == "DONEGAL" ) { echo 'selected="selected"'; } ?>>DONEGAL</option>
                    <option value="DUBLIN" <?php if( isset( $county ) && $county == "DUBLIN" ) { echo 'selected="selected"'; } ?>>DUBLIN</option>
                    <option value="GALWAY" <?php if( isset( $county ) && $county == "GALWAY" ) { echo 'selected="selected"'; } ?>>GALWAY</option>
                    <option value="KERRY" <?php if( isset( $county ) && $county == "KERRY" ) { echo 'selected="selected"'; } ?>>KERRY</option>
                    <option value="KILDARE" <?php if( isset( $county ) && $county == "KILDARE" ) { echo 'selected="selected"'; } ?>>KILDARE</option>
                    <option value="KILKENNY" <?php if( isset( $county ) && $county == "KILKENNY" ) { echo 'selected="selected"'; } ?>>KILKENNY</option>
                    <option value="LAOIS" <?php if( isset( $county ) && $county == "LAOIS" ) { echo 'selected="selected"'; } ?>>LAOIS</option>
                    <option value="LEITRIM" <?php if( isset( $county ) && $county == "LEITRIM" ) { echo 'selected="selected"'; } ?>>LEITRIM</option>
                    <option value="LIMERICK" <?php if( isset( $county ) && $county == "LIMERICK" ) { echo 'selected="selected"'; } ?>>LIMERICK</option>
                    <option value="LONGFORD" <?php if( isset( $county ) && $county == "LONGFORD" ) { echo 'selected="selected"'; } ?>>LONGFORD</option>
                    <option value="LOUTH" <?php if( isset( $county ) && $county == "LOUTH" ) { echo 'selected="selected"'; } ?>>LOUTH</option>
                    <option value="MAYO" <?php if( isset( $county ) && $county == "MAYO" ) { echo 'selected="selected"'; } ?>>MAYO</option>
                    <option value="MEATH" <?php if( isset( $county ) && $county == "MEATH" ) { echo 'selected="selected"'; } ?>>MEATH</option>
                    <option value="MONAGHAN" <?php if( isset( $county ) && $county == "MONAGHAN" ) { echo 'selected="selected"'; } ?>>MONAGHAN</option>
                    <option value="OFFALY" <?php if( isset( $county ) && $county == "OFFALY" ) { echo 'selected="selected"'; } ?>>OFFALY</option>
                    <option value="ROSCOMMON" <?php if( isset( $county ) && $county == "ROSCOMMON" ) { echo 'selected="selected"'; } ?>>ROSCOMMON</option>
                    <option value="SLIGO" <?php if( isset( $county ) && $county == "SLIGO" ) { echo 'selected="selected"'; } ?>>SLIGO</option>
                    <option value="TIPPERARY" <?php if( isset( $county ) && $county == "TIPPERARY" ) { echo 'selected="selected"'; } ?>>TIPPERARY</option>
                    <option value="WEXFORD" <?php if( isset( $county ) && $county == "WEXFORD" ) { echo 'selected="selected"'; } ?>>WEXFORD</option>
                    <option value="WICKLOW" <?php if( isset( $county ) && $county == "WICKLOW" ) { echo 'selected="selected"'; } ?>>WICKLOW</option>
                    <option value="WATERFORD" <?php if( isset( $county ) && $county == "WATERFORD" ) { echo 'selected="selected"'; } ?>>WATERFORD</option>
                    <option value="WESTMEATH" <?php if( isset( $county ) && $county == "WESTMEATH" ) { echo 'selected="selected"'; } ?>>WESTMEATH</option>
                </select>
                <label><strong>&nbsp;&nbsp;&nbsp;&nbsp;</strong><label>
                <input type="submit" class="btn btn-primary" name="s" value="Submit" />
            </form>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

        <?php if( isset( $results ) ) { ?>

            <h3 id="loading">Formatting...</h3>

            <table class="table hide" id="ppr-table">
                <thead>
                    <tr>
                        <th>Date Sold</th>
                        <th>Address</th>
                        <th>Amount</th>
                        <th>Atypical</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while( $r = mysql_fetch_assoc( $results ) ) { ?>

                        <tr>
                            <td><?php echo $r['datesold']; ?></td>
                            <td><?php echo $r['address']; ?></td>
                            <td><?php echo $r['amount']; ?></td>
                            <td><?php echo $r['atypical'] ? 'Y' : 'N'; ?></td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>

        <?php mysql_free_result( $results ); ?>

        <?php } else { ?>

            <h3>Warning!</h3>

            <p>
                This site uses client side processing to format, sort and search the results. This means that if, for example,
                you chose all years and Dublin then you can <strong>expect your browser to hang for a number of seconds while
                it organises the data</strong>.
            </p>

            <h3>About</h3>

            <p>
                This site is a quick hack by <a href="http://www.opensolutions.ie/">Open Solutions</a> to make the Residential Property 
                Pricing database more easily accessible than the cumbersome effort by the 
                <a href="http://propertypriceregister.ie/">Property Services Regulatory Authority</a> themselves.
            </p>
            
            <p>
                All property price data is the copyright of <a href="http://propertypriceregister.ie/website/npsra/ppr-home-en.html">The 
                Property Services Regulatory Authority</a> and has been reused on this site in compliance of their conditions as
                <a href="http://propertypriceregister.ie/website/npsra/ppr-copyright-en.html">set out here</a>.
            </p>

            <p>
                This site is built using open source software from <a href="http://jquery.com/">jQuery</a>,
                Twitter <a href="http://twitter.github.com/bootstrap/">Bootstrap</a> and
                <a href="http://datatables.net/">DataTables</a>. This site uses the aggregated data
                provided by <a href="http://brianmlucey.wordpress.com/2012/09/30/full-property-price-details-ireland-jan-2010-sep-2012/">Brian
                M. Lucey</a>.
            </p>
            
            <p>
                The code for this website is available under the <a href="http://opensource.org/licenses/BSD-3-Clause">New BSD License</a>
                and can be accessed and downloaded from <a href="https://github.com/barryo/property-price-register">GitHub</a>.
            </p>
            
            <h3>Other Versions</h3>
            
            <ul>
                <li> <a href="http://propertypriceregister.ie/Website/npsra/pprweb.nsf/PPR?OpenForm">Official Version</a> </li>
                <li> <a href="http://conoroneill.net/quick-n-dirty-visualisation-of-2010-property-price-register-data-into-interactive-map/">Google Maps Visualisation</a> </li>
                <li> <a href="http://yellowschedule.com/house_price_database_ireland/">Another Search Interface (by YellowSchedule)</a> </li>
                <li> <a href="http://salesporn.net/ppr/">salesporn.net</a> </li>
            </ul>
            
            <h3>Disclaimer</h3>

            <p>
                THIS WEBSITE IS PROVIDED BY OPEN SOURCE SOLUTIONS LIMITED ''AS IS'' AND ANY
                EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
                WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
                DISCLAIMED. IN NO EVENT SHALL OPEN SOURCE SOLUTIONS LIMITED BE LIABLE FOR ANY
                DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
                (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
                LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
                ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
                (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
                WEBSITE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
            </p>

        <?php } ?>

        </div>
    </div>

    <hr>      

    <footer>
        <p>&copy; Open Source Solutions Limited T/A <a href="http://www.opensolutions.ie/">Open Solutions</a> 2012</p>
    </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        $(document).ready(function() {

            oDataTable = $( '#ppr-table' ).dataTable({
                'iDisplayLength': 50,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                aoColumns: [
                    null,
                    null,
                    {
                        fnRender: function ( o ) {
                            return "&euro;"+o.aData[ o.iDataColumn ];
                        },
                        bUseRendered: false
                    },
                    null
                ]
            });

            $( '#loading' ).hide();
            $( '#ppr-table' ).show();
        });

    </script>
    
    <!-- Piwik --> 
    <script type="text/javascript">
    var pkBaseURL = (("https:" == document.location.protocol) ? "https://stats.opensolutions.ie/" : "http://stats.opensolutions.ie/");
    document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
    </script><script type="text/javascript">
    try {
    var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 9);
    piwikTracker.trackPageView();
    piwikTracker.enableLinkTracking();
    } catch( err ) {}
    </script><noscript><p><img src="http://stats.opensolutions.ie/piwik.php?idsite=9" style="border:0" alt="" /></p></noscript>
    <!-- End Piwik Tracking Code -->
  </body>
</html>

