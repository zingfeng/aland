<?php $profile = $this->permission->getIdentity(); ?>
<span class="navbar-text navigation-top__user">
    <figure class="navigation-top__user">
        <img class="avatar" src="<?php echo $profile['avatar'] ?>">
        <figcaption>
            Hi, <strong><?php echo $profile['fullname'];?></strong>
        </figcaption>
    </figure>
</div>