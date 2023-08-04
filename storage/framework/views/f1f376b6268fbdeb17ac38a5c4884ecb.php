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
            詳細画面
        </h2>
     <?php $__env->endSlot(); ?>
    
    
    <div class="show-container">
        <div class="wrapper">
            <table class="table">
                <tr><th>商品ID</th><td>No.<?php echo e($product->id); ?></td></tr>
                <tr><th>商品名</th><td><?php echo e($product->product_name); ?></td></tr>
                <tr><th>価格</th><td><?php echo e($product->price); ?></td></tr>
                <tr><th>在庫数</th><td><?php echo e($product->stock); ?></td></tr>
                <tr><th>メーカー</th><td><?php echo e($product->company_name); ?></td></tr>
                <tr><th>商品詳細</th><td><?php echo e($product->comment); ?></td></tr>
            </table>      
            <div>
                <img class="img" src="<?php echo e(asset('storage/image/' . $product->image_path)); ?>" />
            </div>
            <div>
                <button class="btn" onclick="window.location.href='<?php echo e(route('edit', ['id' => $product->id])); ?>'">編集</button>
            </div>
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
<?php endif; ?><?php /**PATH /var/www/html/resources/views/show.blade.php ENDPATH**/ ?>