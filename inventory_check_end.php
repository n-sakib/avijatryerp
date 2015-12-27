
                  </div>
                </div>
              </div>
              
            </div>
            
            
            
            
            
            
            
            
            
            
            
          </div>
        </div>
      </div>
      <!--/.fluid-container-->
    </div>
    <footer>
      <p>
        &copy; CodeCharley
      </p>
    </footer>
    
    <script src="js/wysiwyg/wysihtml5-0.3.0.js">
    </script>
    <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.scrollUp.js">
    </script>
    <script src="js/wysiwyg/bootstrap-wysihtml5.js">
    </script>
    <script src="js/bootstrap-colorpicker.js">
    </script>
    <script type="text/javascript" src="js/date-picker/date.js">
    </script>
    <script type="text/javascript" src="js/date-picker/daterangepicker.js">
    </script>
    <script type="text/javascript" src="js/clockface.js">
    </script>
    <script type="text/javascript" src="js/bootstrap-timepicker.js">
    </script>
    <script type="text/javascript" src="js/jquery.bootstrap.wizard.js">
    </script>
    
    
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Scroll to top', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      //Tooltip
      $('a').tooltip('hide');

      //Popover
      $('.popover-pop').popover('hide');

      //Collapse
      $('#myCollapsible').collapse({
        toggle: false
      })

      //Tabs
      $('.myTabBeauty a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
      })

      //Dropdown
      $('.dropdown-toggle').dropdown();

      //wysihtml5
      $('#wysiwyg').wysihtml5();

      //Color picker
      $('.colorpicker').colorpicker();

      //Bootstrap Timepicker
      $('#timepicker1').timepicker();

      $('#timepicker2').timepicker({
        minuteStep: 1,
        secondStep: 5,
        showInputs: false,
        template: 'modal',
        modalBackdrop: true,
        showSeconds: true,
        showMeridian: false
      });

      $('#timepicker3').timepicker({
        minuteStep: 5,
        secondStep: 30,
        showInputs: false,
        showSeconds: true,
        showMeridian: false
      });


      //Time Picker Clockface Plugin
      $(function () {

        $('#time1').clockface({
          format: 'HH:mm',
          trigger: 'manual'
        });

        $('#toggle-btn').click(function (e) {
          e.stopPropagation();
          $('#time1').clockface('toggle');
        });

      });

      //Date picker
      $('.date_picker').daterangepicker({
        opens: 'right'
      });

      //Date Picker

      $('.report_range').daterangepicker({
        ranges: {
          'Today': ['today', 'today'],
          'Yesterday': ['yesterday', 'yesterday'],
          'Last 7 Days': [Date.today().add({
            days: -6
          }), 'today'],
          'Last 30 Days': [Date.today().add({
            days: -29
          }), 'today'],
          'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
          'Last Month': [Date.today().moveToFirstDayOfMonth().add({
            months: -1
          }), Date.today().moveToFirstDayOfMonth().add({
            days: -1
          })]
        },
        opens: 'right',
        format: 'MM/dd/yyyy',
        separator: ' to ',
        startDate: Date.today().add({
          days: -29
        }),
        endDate: Date.today(),
        minDate: '01/01/2012',
        maxDate: '12/31/2013',
        locale: {
          applyLabel: 'Submit',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom Range',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        },
        showWeekNumbers: true,
        buttonClasses: ['btn-danger']
      },

      function (start, end) {
        $('.report_range span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
      });

      //Set the initial state of the picker label
      $('.report_range span').html(Date.today().add({
        days: -29
      }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));


      //Wizard Progressbar

      $('#inverse').bootstrapWizard({
        'tabClass': 'nav',
        'debug': false,
        onShow: function (tab, navigation, index) {
          console.log('onShow');
        },
        onNext: function (tab, navigation, index) {
          console.log('onNext');
          if (index == 2) {
            // Make sure we entered the name
            if (!$('#name').val()) {
              alert('You must enter your name');
              $('#name').focus();
              return false;
            }
          }

          // Set the name for the next tab
          $('#inverse-tab3').html('Hello, ' + $('#name').val());

        },
        onPrevious: function (tab, navigation, index) {
          console.log('onPrevious');
        },
        onLast: function (tab, navigation, index) {
          console.log('onLast');
        },
        onTabClick: function (tab, navigation, index) {
          console.log('onTabClick');
          alert('on tab click disabled');
          return false;
        },
        onTabShow: function (tab, navigation, index) {
          console.log('onTabShow');
          var $total = navigation.find('li').length;
          var $current = index + 1;
          var $percent = ($current / $total) * 100;
          $('#inverse').find('.bar').css({
            width: $percent + '%'
          });
        }
      });


      //Wizard Progressbar tabs left

      $('#tabsleft').bootstrapWizard({
        'tabClass': 'nav nav-tabs',
        'debug': false,
        onShow: function (tab, navigation, index) {
          console.log('onShow');
        },
        onNext: function (tab, navigation, index) {
          console.log('onNext');
        },
        onPrevious: function (tab, navigation, index) {
          console.log('onPrevious');
        },
        onLast: function (tab, navigation, index) {
          console.log('onLast');
        },
        onTabClick: function (tab, navigation, index) {
          console.log('onTabClick');

        },
        onTabShow: function (tab, navigation, index) {
          console.log('onTabShow');
          var $total = navigation.find('li').length;
          var $current = index + 1;
          var $percent = ($current / $total) * 100;
          $('#tabsleft').find('.bar').css({
            width: $percent + '%'
          });

          // If it's the last tab then hide the last button and show the finish instead
          if ($current >= $total) {
            $('#tabsleft').find('.pager .next').hide();
            $('#tabsleft').find('.pager .finish').show();
            $('#tabsleft').find('.pager .finish').removeClass('disabled');
          } else {
            $('#tabsleft').find('.pager .next').show();
            $('#tabsleft').find('.pager .finish').hide();
          }

        }
      });


      $('#tabsleft .finish').click(function () {
        alert('Finished!, Starting over!');
        $('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
      });
    </script>
    <script type="text/javascript" src="inventory_check_script.js"></script>
    <script type="text/javascript" src="ignore_key.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".pseudoClear").click(function(){
            var confirmed = confirm('আপনি কি এন্ট্রিগুলো ক্লিয়ার করতে চান?');
            if(confirmed){
              $("#submitBtn").click();
            }
          });
      });
    </script>
  </body>
</html>