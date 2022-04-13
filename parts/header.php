</head>

<body>
  <div class="header">
    <div class="header-item"><span onclick="document.location.href='menu.php'" style="cursor:pointer;">Меню</span><br /></div>
    <div class=" header-item"></div>
    <div class="header-item">
      <div class="label-operator">Оператор:</div>
      <div class="name-operator" id="name-operator"><?php echo $_COOKIE['name_emp']; ?>
      </div>
    </div>
  </div>