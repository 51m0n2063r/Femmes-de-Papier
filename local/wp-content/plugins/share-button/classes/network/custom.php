<?php
namespace MBSocial;

class customNetwork extends mbNetwork
{

  protected $priority = 'readmore';
  protected $is_native = false;


  /** Function to set default for custom networks to the data that was imported from remote.
  *
  * Start state of custom network is all these defaults, but no save on the main settings branch
  */
  public function get_all_defaults()
  {
     $network = MBSocial()->networks()->getNetworkSettings();
     //var_dump($network); var_dump($this->network);
     if (isset($network['custom'][$this->network]))
     {

       $settings = $network['custom'][$this->network];

       $all_options = $this->get_all_options();
    //   echo "<PRE>"; print_R($settings); print_r($all_options);
       foreach($all_options as $option => $value)
       {
         if (isset($settings[$option]))
         {
           $all_options[$option] = $settings[$option];
         }
       }
     }
     return $all_options;
  }

  public function load_settings($settings)
  {
     parent::load_settings($settings);

     if (isset($settings['name']))
     {
       $this->network = $settings['name'];
     }

    /*  foreach($fields as $name => $value)
      {
        if ($name == 'name')
          $name = 'network';
        if ($name == 'popup')
          $name = 'is_popup';

        echo " $name - $value <BR>";

        if ($value && strlen($value) > 0)
        $this->{$name} = $value;
      }
*/
  }
}
