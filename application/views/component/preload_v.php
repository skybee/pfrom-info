<div class="page-preload-bg">
    <div class="page-preload-animate" ></div>
</div>

<style>
    
    .page-preload-bg{
        position: fixed;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        z-index: 999;
    }
    

.page-preload-animate {
    display: inline-block;
    width: 135px;
    height: 135px;
  
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

}
.page-preload-animate:after {
  content: " ";
  display: block;
  width: 120px;
  height: 120px;
  margin: 5px;
  border-radius: 50%;
  border: 6px solid #f00;
  border-color: #009DDB transparent #009DDB transparent;
  animation: page-preload-animate 2s linear infinite;
}
@keyframes page-preload-animate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
    
</style>