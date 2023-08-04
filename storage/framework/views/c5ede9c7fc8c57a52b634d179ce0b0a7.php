
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="<?php echo e(route('index')); ?>">商品一覧</a>
        </h2>
     <?php $__env->endSlot(); ?>
   
  
  <div class="container">
    <form action="<?php echo e(route('search')); ?>" method="GET" enctype="multipart/form-data" id="search" class="search-form">
      <?php echo csrf_field(); ?>
      <div class="box">
      <label class="label">メーカーを選択</label>
        <select class="select-box" name="company">
          <option value="">All categories</option>
            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>              
            <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <label class="label">キーワード検索</label>
        <input class="keyword-box" name="keyword" type="text" placeholder="キーワードを入力">
      </div>
        
        <div class="box">
        <label class="label">価格</label>
        <input class="min_price" type="text" name="min_price" placeholder="下限価格"> 〜
        <input class="max_price" type="text" name="max_price" placeholder="上限価格">

        <label class="label">在庫数</label>
        <input class="min_stock" type="text" name="min_stock" placeholder="下限在庫数"> 〜
        <input class="max_stock" type="text" name="max_stock" placeholder="上限在庫数">

        <button type="submit" id="search-button" class="search-btn">検索</button>
      </div>   
    </form>
  </div>

  
  <div class="container" id="message-box">
    <button onclick="location.href='./create'" class="btn">新規登録</button>
      <?php if(session('success')): ?>
      <div class="alert alert-success">
        <?php echo e(session('success')); ?>

      </div>
      <?php endif; ?>
  </div>

  
  <div class="table-container" id ="table" >
    <table class="table tablesorter">
      <thead>
        <tr>
          <th scope="col" class="table-header">ID</th>
          <th scope="col" class="table-header">イメージ</th>
          <th scope="col" class="table-header">商品名</th>
          <th scope="col" class="table-header">価格</th>
          <th scope="col" class="table-header">在庫数</th>
          <th scope="col" class="table-header">メーカー</th>
          <th scope="col" class="table-header"></th>
          <th scope="col" class="table-header"></th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="table-row" data-id="<?php echo e($product->id); ?>" >
              <td class="table-data"><?php echo e($product->id); ?></td>
              <td class="table-data">
                <img width="50px" src="<?php echo e(asset('storage/image/' . $product->image_path)); ?>">
              </td>
              <td class="table-data"><?php echo e($product->product_name); ?></td>
              <td class="table-data">¥<?php echo e($product->price); ?></td>
              <td class="table-data"><?php echo e($product->stock); ?></td>
              <td class="table-data"><?php echo e($product->company_name); ?></td>
              <td class="table-data">
                <a class="a-btn" href="<?php echo e(route('show', ['id' => $product->id])); ?>">詳細</a>              
                <form class="del-form" method="post" action="<?php echo e(route('delete',['id' => $product->id])); ?>">
                  <?php echo csrf_field(); ?>
                  <button data-id="<?php echo e($product->id); ?>" type="submit" class="a-btn del-btn">削除</button>                
                </form>
              </td>
              <td>
                <a href="<?php echo e(route('cart', ['id' => $product->id])); ?>" class="cart-btn">購入する</a>
              </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
      </tbody>
    </table>
      <?php echo e($products->appends(request()->query())->links()); ?>

  </div>

  <script>
    
    // テーブルソート機能
    $(function(){
      $('.table').tablesorter();
    });

    // 非同期削除
    $(function() {
      $('.del-btn').click(function(e) {
        e.preventDefault();  
        let deleteConfirm = confirm('削除してよろしいでしょうか？');
        if(deleteConfirm === true) {
          let userId = $(this).attr('data-id');
          let row = $('.table-row[data-id="' + userId + '"]');    
          $.ajax({
            headers: {
              'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/delete/' + userId,
            data: {
              id : userId
            },
            dataType: 'json'
          })
          .done(function(data){
            row.hide();
            showMessage(data.message);          
          })
          .fail(function(error){
            console.log('fail');
          }) 
        }       
      });
    });
    function showMessage(message) {
    let messageBox = $('#message-box');
    messageBox.find('.alert').remove();
    messageBox.append('<div class="alert alert-success">' + message + '</div>');
    messageBox.show();
    }

    // 非同期検索
    $(function() {
      $('#search-button').click(function(e){
        e.preventDefault(); 
        let $company = $('.select-box').val();
        let $keyword = $('.keyword-box').val();
        let $min_price = $('.min_price').val();
        let $max_price = $('.max_price').val();
        let $min_stock = $('.min_stock').val();
        let $max_stock = $('.max_stock').val();

        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: '/search',
          type: 'GET', 
          data: { 
                  "keyword": $keyword,
                  "company": $company,
                  "min_price": $min_price,
                  "max_price": $max_price,
                  "min_stock": $min_stock,
                  "max_stock": $max_stock, 
                },
          datatType:'json',

        }).done(function(products){
            console.log('success');
            let table = $('.table tbody');
            table.empty();
            let html = '';
            
            for (let i = 0; i < products.data.length; i++) {
              let id = products.data[i].id;
              let image_path = products.data[i].image_path;
              let name = products.data[i].product_name;
              let price = products.data[i].price;
              let stock = products.data[i].stock;
              let company = products.data[i].company_name;
              html = `
                      <tr class="table-row">
                        <td class="table-data">${id}</td>
                        <td class="table-data"><img width="50px" src="http://localhost/storage/image/${image_path}"/></td>
                        <td class="table-data">${name}</td>                              
                        <td class="table-data">¥${price}</td>
                        <td class="table-data">${stock}</td>
                        <td class="table-data">${company}</td>
                        <td class="table-data"><a class="a-btn" href="/show/${id}">詳細</a>
                          <form class="del-form" method="post" action="<?php echo e(route('delete',['id' => $product->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <button data-id="<?php echo e($product->id); ?>" type="submit" class="a-btn del-btn">削除</button>   
                          </form>
                        </td>                            
                        <td class="table-data"><a class="cart-btn" href="/cart/${id}">購入する</a></td>
                      </tr>
                    `
              table.append(html);
              }
          }).fail(function(error){
            console.log("fail", error);
          })
      });
    });
  </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>