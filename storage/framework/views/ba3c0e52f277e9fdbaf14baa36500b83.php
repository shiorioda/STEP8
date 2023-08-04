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
            新規登録
        </h2>
     <?php $__env->endSlot(); ?>

    
    <div class="create-container">
        <div class="wrapper">
            <form method="post" action="<?php echo e(route('store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form">
                    <label>商品名</label>
                    <input class="input" type="text" id="name" name="product_name"/>
                </div>
                <div class="form">
                    <label>価格</label>
                    <input class="input" type="number" id="price" name="price"/>
                </div>
                <div class="form">
                    <label>在庫数</label>
                    <input class="input" type="number" name="stock"/>
                </div>
                <div class="form">
                    <label>メーカー</label>
                    <select name="company_id" id="company">
                        <option hidden>選択してください</option>
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form">
                    <label>商品詳細</label>
                    <textarea name="comment" cols="20" rows="5"></textarea>
                </div>
                <div class="form">
                    <label>イメージ</label>
                    <input type="file" name="image_path" id="image_path">
                </div>   
                <div>
                    <button type="submit" class="btn">登録</button>   
                </div>   
                <div>
                    <?php if($errors->any()): ?>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </form> 
        </div>
    </div>   
    <div class="back-page">
        <button class="back-btn" onclick="location.href='<?php echo e(route('index')); ?>'">一覧へ戻る</button>
    </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/create.blade.php ENDPATH**/ ?>