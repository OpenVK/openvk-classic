<?php 

if (!isset($_REQUEST)) { 
  return; 
} 

//Строка для подтверждения адреса сервера из настроек Callback API 
$confirmation_token = '03dfebd5'; 

//Ключ доступа сообщества 
$token = '309166fb0153d384b40b481f900f2e17468f533d8665713e5e826775fc2b9e8b8eabc610405a69e4920c9'; 

//Получаем и декодируем уведомление 
$data = json_decode(file_get_contents('php://input')); 

//Проверяем, что находится в поле "type" 
switch ($data->type) { 
  //Если это уведомление для подтверждения адреса... 
  case 'confirmation': 
    //...отправляем строку для подтверждения 
    echo $confirmation_token; 
    break; 
//Если это уведомление о новом сообщении... 
  case 'message_new':
  if($data->object->body != '!start' || $step != '3'){
    //...получаем id его автора 
    $user_id = $data->object->user_id; 
    //затем с помощью users.get получаем данные об авторе 
    $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 

//и извлекаем из ответа его имя 
    $user_name = $user_info->response[0]->first_name; 

//С помощью messages.send отправляем ответное сообщение 
    $request_params = array( 
      'message' => "Привет, /username/! Напиши !start, что бы подать заявку.", 
      'user_id' => $user_id, 
      'access_token' => $token, 
      'v' => '5.0' 
    );


$get_params = http_build_query($request_params); 

file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
}
//Возвращаем "ok" серверу Callback API 
if($data->object->body == '!start'){
  //...получаем id его автора 
    $user_id = $data->object->user_id; 
    //затем с помощью users.get получаем данные об авторе 
    $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 

//и извлекаем из ответа его имя 
    $user_name = $user_info->response[0]->first_name; 

//С помощью messages.send отправляем ответное сообщение 
    $request_params = array( 
      'message' => "Теперь пиши маленький рассказ о себе.", 
      //'user_id' => "448096293", 
      'user_id' => $user_id,
      'access_token' => $token, 
      'v' => '5.0' 
    );
    $step = '3';


$get_params = http_build_query($request_params); 

file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
} elseif($step == '3') {
  //...получаем id его автора 
    $user_id = $data->object->user_id; 
    //затем с помощью users.get получаем данные об авторе 
    $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 

//и извлекаем из ответа его имя 
    $user_name = $user_info->response[0]->first_name; 

//С помощью messages.send отправляем ответное сообщение 
    $request_params = array( 
      'message' => "Подали новую заявку:\nИмя: ".$user_name."\nТекст: ".$data->object->body, 
      'user_id' => "448096293", 
      'access_token' => $token, 
      'v' => '5.0' 
    );
    $get_params = http_build_query($request_params); 

    file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 

    $request_params = array( 
      'message' => "В скором времени с вами свяжутся.", 
      'user_id' => $user_id, 
      'access_token' => $token, 
      'v' => '5.0' 
    );
    $get_params = http_build_query($request_params); 

    file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
}

echo('ok'); 

break; 

} 
?> 