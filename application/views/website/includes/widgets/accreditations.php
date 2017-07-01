<div class="widget">
    <div class="widget-title">
        <h2>Accreditations</h2>
    </div><!--/.widget-title -->

    <div class="widget-content">
		<?php foreach($env['accreditations'] as $accreditation):?>
		 <div class="agent-small">
            <div class="agent-small-inner">
                <div class="agent-small-image">
                    <a href="/accreditation/<?=$accreditation->id;?>" class="agent-small-image-inner">
                        <img src="/assets/img/accreditation/<?=$accreditation->image;?>" alt="<?=$accreditation->name;?>">
                    </a><!-- /.agent-small-image-inner -->
                </div><!-- /.agent-small-image -->

                <div class="agent-small-content">
                    <h3 class="agent-small-title">
                        <a href="/accreditation/<?=$accreditation->id;?>"><?=$accreditation->title;?></a>
                    </h3>

                    <div class="agent-small-email">
                        <i class="fa fa-check"></i> <a href="/accreditation/<?=$accreditation->id;?>"><?=$accreditation->tagline;?></a>
                    </div><!-- /.agent-small-email -->
                </div><!-- /.agent-small-content -->
            </div><!-- /.agent-small-inner -->
        </div><!-- /.agent-small -->
		<?php endforeach;?>
    </div><!-- /.widget-content -->
</div>