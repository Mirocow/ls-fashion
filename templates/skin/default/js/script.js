jQuery(document).ready(function($){
  // Хук начала инициализации javascript-составляющих шаблона
  ls.hook.run('ls_template_init_start',[],window);

  // Иницивлизация всплывающих окон
  $('#window_register_form').jqm();
  ls.blocks.initSwitch('popup-register');

  // Хук конца инициализации javascript-составляющих шаблона
  ls.hook.run('ls_template_init_end',[],window);
});
