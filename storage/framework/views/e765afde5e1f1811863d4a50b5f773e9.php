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
            購入画面
        </h2>
     <?php $__env->endSlot(); ?>
    
    
    <div class="show-container">
        <div class="wrapper">
            <form method="post" action="<?php echo e(route('purchase', ['id' => $product->id])); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div>
                    <img class="purchase-img" src="<?php echo e(asset('storage/image/' . $product->image_path)); ?>" />
                </div>
                <div class="purchase-name">
                    <?php echo e($product->id); ?>.  <?php echo e($product->product_name); ?> (¥<?php echo e($product->price); ?>)
                </div>

                <?php if($product->stock > 0): ?>
                <div class="purchase">
                    <input type="number" name="quantity" min="1"> 
                    <button type="submit">購入する</button>
                </div>
                <?php else: ?>
                <p>※在庫切れです</p>
                <?php endif; ?>
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
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/cart.blade.php ENDPATH**/ ?>