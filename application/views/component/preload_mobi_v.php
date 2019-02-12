<div class="page-preload-bg">
    <div class="page-preload-text" >loading...</div>
</div>

<style>
    
    .page-preload-bg{
        display: none;
        position: fixed;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        z-index: 999;
    }
    
    @media screen and (max-width: 980px) {
        .page-preload-bg{display: block;}
    }
    
    .page-preload-text{
        color: #fff;
        font-size: 22px;
        
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }
    

    
</style>