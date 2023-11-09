var clicod;
var forcod;
var procod;
var opcod;
var carcod;
var pedcli;
var pedncli;
var pedfor;
var pednfor;
var saicod;
var saipro;
var sainpro;
var saium;
var saiqtd;
var saival;
var saitot;
var saiped;
var nfesit;

function pesquisaCliente() {
    var pesquisa =  document.getElementById('pesquisa').value;
    window.location = "clientes.php?pesquisa="+pesquisa;
}

function pesquisaGrupo(el) {
    habilitaBotao();
    var pesquisa =  document.getElementById('select_grupos').value;
    window.location = "cad_produto_pedido.php?saiped="+el+"&pesquisa="+pesquisa;
}

function alterarCliente(){
    window.location = "cad_cliente.php?clicod="+clicod;
}

function excluirCliente(){
    window.location = "delete_cliente.php?clicod="+clicod;
}

function enterCliente(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "clientes.php?pesquisa="+pesquisa;
    }
}

function enterFaturamento(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "faturamento.php?pesquisa="+pesquisa;
    }
}

function enterCompras(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "compras.php?pesquisa="+pesquisa;
    }
}

function selecionaCliente(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  clicod = el.id;
  if (clicod.length > 1){
    clicod = clicod.slice(0, -1);
  }
  
  if(document.getElementById(clicod).style.color == ""){
	document.getElementById(clicod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(clicod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(clicod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(clicod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(clicod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(clicod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(clicod+"F").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(clicod).style.backgroundColor = "";
	document.getElementById(clicod+"A").style.backgroundColor = "";
	document.getElementById(clicod+"B").style.backgroundColor = "";
	document.getElementById(clicod+"C").style.backgroundColor = "";
	document.getElementById(clicod+"D").style.backgroundColor = "";
	document.getElementById(clicod+"E").style.backgroundColor = "";
	document.getElementById(clicod+"F").style.backgroundColor = "";
  } 
}

function alterarFornecedor(){
    window.location = "cad_fornecedor.php?forcod="+forcod;
}

function excluirFornecedor(){
    window.location = "delete_fornecedor.php?forcod="+forcod;
}

function enterFornecedor(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "fornecedores.php?pesquisa="+pesquisa;
    }
}

function selecionaFornecedor(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  forcod = el.id;
  if (forcod.length > 1){
    forcod = forcod.slice(0, -1);
  }
  
  if(document.getElementById(forcod).style.color == ""){
	document.getElementById(forcod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(forcod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(forcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(forcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(forcod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(forcod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(forcod+"F").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(forcod).style.backgroundColor = "";
	document.getElementById(forcod+"A").style.backgroundColor = "";
	document.getElementById(forcod+"B").style.backgroundColor = "";
	document.getElementById(forcod+"C").style.backgroundColor = "";
	document.getElementById(forcod+"D").style.backgroundColor = "";
	document.getElementById(forcod+"E").style.backgroundColor = "";
	document.getElementById(forcod+"F").style.backgroundColor = "";
  }
}


function pesquisaProduto(){
    var pesquisa =  document.getElementById('pesquisa').value;
    window.location = "produtos.php?pesquisa="+pesquisa;
}

function alterarProduto(){
    window.location = "cad_produto.php?procod="+procod;
}

function excluirProduto(){
    window.location = "delete_produto.php?procod="+procod;
}

function enterProduto(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "produtos.php?pesquisa="+pesquisa;
    }
}

function selecionaProduto(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  procod = el.id;
  if (procod.length > 1){
    procod = procod.slice(0, -1);
  }
  
  if(document.getElementById(procod).style.color == ""){
	document.getElementById(procod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(procod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(procod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(procod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(procod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(procod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(procod+"F").style.backgroundColor = "#ADADFF";	
  } else {
	document.getElementById(procod).style.backgroundColor = "";
	document.getElementById(procod+"A").style.backgroundColor = "";
	document.getElementById(procod+"B").style.backgroundColor = "";
	document.getElementById(procod+"C").style.backgroundColor = "";
	document.getElementById(procod+"D").style.backgroundColor = "";
	document.getElementById(procod+"E").style.backgroundColor = "";
	document.getElementById(procod+"F").style.backgroundColor = "";	
  }
  
}

function alterarVeiculo(){
    window.location = "cad_veiculo.php?carcod="+carcod;
}

function excluirVeiculo(){
    window.location = "delete_veiculo.php?carcod="+carcod;
}

function enterVeiculo(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "veiculos.php?pesquisa="+pesquisa;
    }
}

function selecionaVeiculo(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  carcod = el.id;
  if (carcod.length > 1){
    carcod = carcod.slice(0, -1);
  }
  
  if(document.getElementById(carcod).style.color == ""){     	  
    document.getElementById(carcod).style.backgroundColor = "#ADADFF";
	document.getElementById(carcod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(carcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(carcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(carcod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(carcod+"E").style.backgroundColor = "#ADADFF";
  } else {	
    document.getElementById(carcod).style.backgroundColor = "";
	document.getElementById(carcod+"A").style.backgroundColor = "";
	document.getElementById(carcod+"B").style.backgroundColor = "";
	document.getElementById(carcod+"C").style.backgroundColor = "";
	document.getElementById(carcod+"D").style.backgroundColor = "";
	document.getElementById(carcod+"E").style.backgroundColor = "";
  } 
  
}

function pesquisaVendedor(){
    var pesquisa =  document.getElementById('pesquisa').value;
    window.location = "vendedores.php?pesquisa="+pesquisa;
}

function alterarVendedor(){
    window.location = "cad_vendedor.php?opcod="+opcod;
}

function excluirVendedor(){
    window.location = "delete_vendedor.php?opcod="+opcod;
}

function enterVendedor(){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "vendedores.php?pesquisa="+pesquisa;
    }
}

function selecionaVendedor(el){    
    var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  opcod = el.id;
  if (opcod.length > 1){
    opcod = opcod.slice(0, -1);
  }
  
  if(document.getElementById(opcod).style.backgroundColor == ""){
	document.getElementById(opcod).style.backgroundColor = "#ADADFF";
	document.getElementById(opcod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(opcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(opcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(opcod+"D").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(opcod).style.backgroundColor = "";
	document.getElementById(opcod+"A").style.backgroundColor = "";
	document.getElementById(opcod+"B").style.backgroundColor = "";
	document.getElementById(opcod+"C").style.backgroundColor = "";
	document.getElementById(opcod+"D").style.backgroundColor = "";
  } 
}

function pesquisaPedido(){
    var pesquisa =  document.getElementById('pesquisa').value;
    window.location = "pedidos.php?pesquisa="+pesquisa;
}

function alterarPedido(){
    window.location = "produtos_pedido.php?pedcod="+pedcod;
}

function excluirPedido(tipo_pedido){
	var dialog = confirm("DESEJA REALMENTE EXCLUIR ESSE PEDIDO?");
	if (dialog) {
		window.location = "delete_pedido.php?pedcod="+pedcod+"&tipo_pedido="+tipo_pedido;
	}
	else {
		
	}
}

function enviarPedido(){
    window.location = "email_pedido.php?pedcod="+pedcod;
}

function enviarPedido2(pedido){
    window.location = "email_pedido.php?pedcod="+pedido;
}

function enviarDanfeXML(){
    window.location = "email_danfexml.php?pedcod="+pedcod;
}

function enterPedido(compras_vendas){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value; 
        window.location = "pedidos.php?pesquisa="+pesquisa+compras_vendas;
    }
}

function enterClientePedido(compras_vendas){              
 
        var pesquisa =  document.getElementById('select_pedidos').value; 
        window.location = "pedidos.php?pesquisa="+pesquisa+compras_vendas;
}

function enterClienteFaturamento(tipo_fat){              
 
        var pesquisa =  document.getElementById('select_faturamento').value; 
        window.location = "faturamento.php?pesquisa="+pesquisa+tipo_fat;
}

function selecionaNfe(el, sit){
  
  nfesit = sit;
  
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  pedcod = el.id;
  if (pedcod.length > 1){
    pedcod = pedcod.slice(0, -1);
  }
  
  if(document.getElementById(pedcod).style.color == ""){
	document.getElementById(pedcod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(pedcod+"A").style.backgroundColor = "#ADADFF";	
	document.getElementById(pedcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"F").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"G").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"H").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"I").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(pedcod).style.backgroundColor = "";
	document.getElementById(pedcod+"A").style.backgroundColor = "";	
	document.getElementById(pedcod+"B").style.backgroundColor = "";
	document.getElementById(pedcod+"C").style.backgroundColor = "";
	document.getElementById(pedcod+"D").style.backgroundColor = "";
	document.getElementById(pedcod+"E").style.backgroundColor = "";
	document.getElementById(pedcod+"J").style.backgroundColor = "";
	document.getElementById(pedcod+"G").style.backgroundColor = "";
	document.getElementById(pedcod+"H").style.backgroundColor = "";
	document.getElementById(pedcod+"I").style.backgroundColor = "";
  }   
}

function selecionaCompra(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  pedcod = el.id;
  if (pedcod.length > 1){
    pedcod = pedcod.slice(0, -1);
  }
  
  if(document.getElementById(pedcod).style.color == ""){
	document.getElementById(pedcod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(pedcod+"A").style.backgroundColor = "#ADADFF";	
	document.getElementById(pedcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"D").style.backgroundColor = "#ADADFF";
    document.getElementById(pedcod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"F").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(pedcod).style.backgroundColor = "";
	document.getElementById(pedcod+"A").style.backgroundColor = "";	
	document.getElementById(pedcod+"B").style.backgroundColor = "";
	document.getElementById(pedcod+"C").style.backgroundColor = "";
	document.getElementById(pedcod+"D").style.backgroundColor = "";
    document.getElementById(pedcod+"E").style.backgroundColor = "";
	document.getElementById(pedcod+"F").style.backgroundColor = "";
  } 
}

function selecionaPedido(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  pedcod = el.id;
  if (pedcod.length > 1){
    pedcod = pedcod.slice(0, -1);
  }
  
  if(document.getElementById(pedcod).style.color == ""){
	document.getElementById(pedcod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(pedcod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(pedcod+"F").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(pedcod).style.backgroundColor = "";
	document.getElementById(pedcod+"A").style.backgroundColor = "";
	document.getElementById(pedcod+"B").style.backgroundColor = "";
	document.getElementById(pedcod+"C").style.backgroundColor = "";
	document.getElementById(pedcod+"D").style.backgroundColor = "";
	document.getElementById(pedcod+"E").style.backgroundColor = "";
	document.getElementById(pedcod+"F").style.backgroundColor = "";	
  }
}

function imprimirPedido(){
    window.open("pdf_pedido.php?pedcod="+pedcod);
}

function imprimirPedido2(pedido){
   window.open("pdf_pedido.php?pedcod="+pedido);
}

function selecionaClientePedido(){      
    pedcli = document.form_cad_pedido.select_cad_pedido.value;
    pedcli = pedcli.substring(0,pedcli.indexOf(" -"));
    pedncli = document.form_cad_pedido.select_cad_pedido.value;
    pedncli = pedncli.substring(pedncli.indexOf("-")+2);
    habilitaBotao();
}

function selecionaFornecedorPedido(){      
    pedfor = document.form_cad_pedido.select_cad_pedido.value;
    pedfor = pedfor.substring(0,pedfor.indexOf(" -"));
    pednfor = document.form_cad_pedido.select_cad_pedido.value;
    pednfor = pednfor.substring(pednfor.indexOf("-")+2);
    habilitaBotao();
}

function confirmaClientePedido(){
    window.location = "insert_pedido.php?pedcli="+pedcli+"&pedncli="+pedncli;
}

function ConfirmaUnificar(cliente_unificar)
{
  var x = confirm("DESEJA REALMENTE UNIFICAR OS PEDIDOS PENDENTES DESSE CLIENTE?");
  if (x){
      window.location = "unifica_pedidos.php?pedcli="+cliente_unificar;
  }
}

/*function ConfirmaUnificar(pedido_unificar,cliente_unificar)
{
  var x = confirm("DESEJA REALMENTE UNIFICAR OS PEDIDOS PENDENTES DESSE CLIENTE?");
  if (x){
      window.location = "unifica_pedidos.php?pedcod="+pedido_unificar+"&pedcli="+cliente_unificar;
  }
}*/

function confirmaFornecedorPedido(){
    window.location = "insert_pedido.php?pedfor="+pedfor+"&pednfor="+pednfor;
}


function incluiProdutoPedido(){  
    var val;  
    var tot;
    var imagem;
	saipro = document.form_cad_produto_pedido.select_cad_produto_pedido.value;
	saipro = saipro.substring(saipro.indexOf("[")+1, saipro.indexOf("]"));	
	imagem = "background-image: url('img/prod/";
	imagem = imagem.concat(saipro);
	imagem = imagem.concat(".jpg')");
	document.getElementById("imagem").setAttribute("style", imagem);
	sainpro = document.form_cad_produto_pedido.select_cad_produto_pedido.value;
	sainpro = sainpro.substring(sainpro.indexOf("]")+1);
	var apoio = document.form_cad_produto_pedido.select_cad_produto_pedido.value;
	apoio = apoio.substring(apoio.indexOf("(")+1,apoio.indexOf(" /"));
	document.form_cad_produto_pedido.saium.value = apoio;
	apoio = document.form_cad_produto_pedido.select_cad_produto_pedido.value;
	apoio = apoio.substring(apoio.indexOf("/ ")+1, apoio.indexOf(")"));
	apoio = apoio.replace(' ','');
	document.form_cad_produto_pedido.saival.value = apoio;
	document.form_cad_produto_pedido.saitot.value = document.form_cad_produto_pedido.saiqtd.value*apoio;        
	val = document.form_cad_produto_pedido.saival.value;            
	document.form_cad_produto_pedido.saival.value = 'R$ '.concat(val.replace('.',','));
	tot = document.form_cad_produto_pedido.saitot.value;            
	document.form_cad_produto_pedido.saitot.value = 'R$ '.concat(tot.replace('.',','));
	habilitaBotao();	
}

function confirmaProdutoPedido(saicod){ 
	aux2 = document.form_cad_produto_pedido.select_cad_produto_pedido.value;	
	if (aux2.length < 1) {
			alert('NECESSÁRIO SELECIONAR O PRODUTO.');
	} else {
		//incluiProdutoPedido();
		aux = sainpro.substring(sainpro.indexOf("(")-1, sainpro.indexOf(")")+1);
		sainpro = sainpro.replace(aux,'');    
		saium = document.form_cad_produto_pedido.saium.value;
		saigrupo = document.form_cad_produto_pedido.select_cad_grupo_pedido.value;    
		saiqtd = document.form_cad_produto_pedido.saiqtd.value;
		saival = document.form_cad_produto_pedido.saival.value;
		saitot = document.form_cad_produto_pedido.saitot.value;
		saiped = document.form_cad_produto_pedido.saiped.value;
		window.location = "insert_produto_pedido.php?saicod="+saicod+"&saipro="+saipro+"&sainpro="+sainpro+"&saium="+saium+"&saiqtd="+saiqtd+"&saival="+saival+"&saitot="+saitot+"&saiped="+saiped+"&saigrupo="+saigrupo;
	}
}

function valorProduto(val){
    document.form_cad_produto_pedido.saival.value = val;
}

function umProduto(um){
    document.form_cad_produto_pedido.saium.value = um;
}

function calculaProduto(){
    var val;	
    var qtd;    
    val = document.form_cad_produto_pedido.saival.value;        
    val = val.replace('R$ ','');
    //document.form_cad_produto_pedido.saival.value = 'R$ '.concat(val.replace('.',','));
    qtd = document.form_cad_produto_pedido.saiqtd.value;
    if (qtd === ''){    	
        document.form_cad_produto_pedido.saiqtd.value = 1;
	qtd = document.form_cad_produto_pedido.saiqtd.value;
	document.form_cad_produto_pedido.saiqtd.select();
    }
    //document.form_cad_produto_pedido.saiqtd.value = qtd.replace('.',',');        
    //val = val.replace('.','');
    saitot = val.replace(',','.')*qtd.replace(',','.');        
    document.form_cad_produto_pedido.saitot.value = 'R$ '.concat((saitot).toLocaleString('pt-BR'));        
}

function calculaProdutoPreco(){
    var val;	
    var qtd;    
    val = document.form_cad_produto_pedido.saival.value;        
    val = val.replace('R$ ','');
    //document.form_cad_produto_pedido.saival.value = 'R$ '.concat(val.replace('.',','));
    qtd = document.form_cad_produto_pedido.saiqtd.value;
    if (qtd === ''){    	
        document.form_cad_produto_pedido.saiqtd.value = 1;
	qtd = document.form_cad_produto_pedido.saiqtd.value;
	document.form_cad_produto_pedido.saiqtd.select();
    }
    //document.form_cad_produto_pedido.saiqtd.value = qtd.replace('.',',');        
    //val = val.replace('.','');
    saitot = val.replace(',','.')*qtd.replace(',','.');        
    document.form_cad_produto_pedido.saitot.value = 'R$ '.concat((saitot).toLocaleString('pt-BR'));        
}

function calculaNota(){
    var frete;	
    var desconto; 
    var total_liquido;
    var total_bruto;    
    frete = document.form_fat_pedido.frete.value;  
    if (frete === ''){    	
        document.form_fat_pedido.frete.value = 0;
	frete = document.form_fat_pedido.frete.value;
	document.form_fat_pedido.frete.select();
    }
    desconto = document.form_fat_pedido.desconto.value;
    if (desconto === ''){    	
        document.form_fat_pedido.desconto.value = 0;
	desconto = document.form_fat_pedido.desconto.value;
	document.form_fat_pedido.desconto.select();
    }    
    total_bruto = document.form_fat_pedido.total_bruto.value;
    frete = frete.replace(',','.');
    desconto = desconto.replace(',','.');
    frete = frete.replace('R$ ','');
    desconto = desconto.replace('R$ ','');
    total_bruto = total_bruto.replace('.','');
    total_bruto = total_bruto.replace(',','.');
    total_bruto = total_bruto.replace('R$ ','');    
    total_liquido = document.form_fat_pedido.total.value;   
    total_liquido = total_liquido.replace('R$ ','');     
    total_liquido = parseFloat(total_bruto)+parseFloat(frete);
    total_liquido = parseFloat(total_liquido)-parseFloat(desconto);    
    total_liquido = total_liquido.toFixed(2);
    document.form_fat_pedido.total.value = 'R$ '.concat((total_liquido).toLocaleString('pt-BR').replace('.',','));    
}

function enterProdutosPedido(pedcod){
              
var keynum;

if(window.event) { //IE
    keynum = event.keyCode
} else if(e.which) { // Netscape/Firefox/Opera
    keynum = event.which
}
if( event.keyCode==13 ) { <!-- 13 é o código do Enter --> 
        var pesquisa =  document.getElementById('pesquisa').value;
        window.location = "produtos_pedido.php?pesquisa="+pesquisa+"&pedcod="+pedcod;
    }
}

function selecionaProdutoPedido(el){    
  var x = document.querySelectorAll("td");
      var i;
      for (i = 0; i < x.length; i++) {
    	x[i].style.backgroundColor = "";
      }
   
  saicod = el.id;
  if (saicod.length > 1){
    saicod = saicod.slice(0, -1);
  }
  
  if(document.getElementById(saicod).style.color == ""){
	document.getElementById(saicod).style.backgroundColor = "#ADADFF";      	
	document.getElementById(saicod+"A").style.backgroundColor = "#ADADFF";
	document.getElementById(saicod+"B").style.backgroundColor = "#ADADFF";
	document.getElementById(saicod+"C").style.backgroundColor = "#ADADFF";
	document.getElementById(saicod+"D").style.backgroundColor = "#ADADFF";
	document.getElementById(saicod+"E").style.backgroundColor = "#ADADFF";
	document.getElementById(saicod+"F").style.backgroundColor = "#ADADFF";
  } else {
	document.getElementById(saicod).style.backgroundColor = "";
	document.getElementById(saicod+"A").style.backgroundColor = "";
	document.getElementById(saicod+"B").style.backgroundColor = "";
	document.getElementById(saicod+"C").style.backgroundColor = "";
	document.getElementById(saicod+"D").style.backgroundColor = "";
	document.getElementById(saicod+"E").style.backgroundColor = "";
	document.getElementById(saicod+"F").style.backgroundColor = "";
  } 
}

function alterarProdutoPedido(pedcod){
    window.location = "cad_produto_pedido.php?saiped="+pedcod+"&saicod="+saicod;
}

function excluirProdutoPedido(pedcod){
    window.location = "delete_produto_pedido.php?saiped="+pedcod+"&saicod="+saicod;
}

function seleciona_texto(valor){
    valor.select();
}

function seleciona_frete(valor){
    var frete;	
    frete = document.form_fat_pedido.frete.value;
    frete = frete.replace('R$ ','');
    document.form_fat_pedido.frete.value = frete;   
    valor.select();
}


function seleciona_desconto(valor){
    var desconto;	
    desconto = document.form_fat_pedido.desconto.value;
    desconto = desconto.replace('R$ ','');
    document.form_fat_pedido.desconto.value = desconto;   
    valor.select();
}

function habilitaBotao(){
    document.getElementById('submit_cadastros').disabled = false;
}

function habilitaImportar(){
    document.getElementById('botao_importar').disabled = false;
}

$(document).ready(function(){            
    $("#select_produtos").select2({	
    })
});

/* $(document).ready(function(){            
    $("#select_pedidos").select2({	
    })
}); */

/* $(document).ready(function(){            
    $("#select_faturamento").select2({	
    })
}); */

$(document).ready(function(){            
    $("#select_login").select2({                
    })
});

$(document).ready(function(){            
    $("#select_clientes").select2({                
    })
});

$(document).ready(function(){            
    $("#select_grupos").select2({                
    })
});

$(document).ready(function(){            
    $("#select_fornecedores").select2({                
    })
});

function faturarPedido(){
	if (nfesit != 'PENDENTE') {
		
	} else {
		
		window.location = "escolhe_emissor.php?pedcod="+pedcod;
		//window.location = "fat_pedido.php?pedcod="+pedcod;
		
	}
}

function finalizaPedido(pesquisa){
    window.location = "finaliza_pedido.php?pedcod="+pedcod+"&"+pesquisa;
}

function finalizaPedido2(pedido){
    window.location = "finaliza_pedido.php?pedcod="+pedido;
}

function faturarPedido2(pedido){
    window.location = "fat_pedido.php?pedcod="+pedido;
}

function cancelarNfe(){
	var dialog = confirm("DESEJA REALMENTE CANCELAR ESSE FATURAMENTO?");
	if (dialog) {
		window.location = "verifica_emissor_cancelamento.php?pedcod="+pedcod
	}
	else {
		
	}
}

function atualizarNfe(){
    window.location = "verifica_emissor_atualizacao.php?pedcod="+pedcod;
}

function imprimirDanfe(){
    window.open("imp_danfe.php?pedcod="+pedcod);
}

function baixarXML(){
    window.open("baixar_xml.php?pedcod="+pedcod);
}

function imprimirDanfe2(chave){
    window.open("imp_danfe.php?pedcod="+chave);
}

var Modal = (function() {

  var trigger = $qsa('.modal__trigger'); // what you click to activate the modal
  var modals = $qsa('.modal'); // the entire modal (takes up entire window)
  var modalsbg = $qsa('.modal__bg'); // the entire modal (takes up entire window)
  var content = $qsa('.modal__content'); // the inner content of the modal
	var closers = $qsa('.modal__close'); // an element used to close the modal
  var w = window;
  var isOpen = false;
	var contentDelay = 400; // duration after you click the button and wait for the content to show
  var len = trigger.length;

  // make it easier for yourself by not having to type as much to select an element
  function $qsa(el) {
    return document.querySelectorAll(el);
  }

  var getId = function(event) {

    event.preventDefault();
    var self = this;
    // get the value of the data-modal attribute from the button
    var modalId = self.dataset.modal;
    var len = modalId.length;
    // remove the '#' from the string
    var modalIdTrimmed = modalId.substring(1, len);
    // select the modal we want to activate
    var modal = document.getElementById(modalIdTrimmed);
    // execute function that creates the temporary expanding div
    makeDiv(self, modal);
  };

  var makeDiv = function(self, modal) {

    var fakediv = document.getElementById('modal__temp');

    /**
     * if there isn't a 'fakediv', create one and append it to the button that was
     * clicked. after that execute the function 'moveTrig' which handles the animations.
     */

    if (fakediv === null) {
      var div = document.createElement('div');
      div.id = 'modal__temp';
      self.appendChild(div);
      moveTrig(self, modal, div);
    }
  };

  var moveTrig = function(trig, modal, div) {
    var trigProps = trig.getBoundingClientRect();
    var m = modal;
    var mProps = m.querySelector('.modal__content').getBoundingClientRect();
    var transX, transY, scaleX, scaleY;
    var xc = w.innerWidth / 2;
    var yc = w.innerHeight / 2;

    // this class increases z-index value so the button goes overtop the other buttons
    trig.classList.add('modal__trigger--active');

    // these values are used for scale the temporary div to the same size as the modal
    scaleX = mProps.width / trigProps.width;
    scaleY = mProps.height / trigProps.height;

    scaleX = scaleX.toFixed(3); // round to 3 decimal places
    scaleY = scaleY.toFixed(3);


    // these values are used to move the button to the center of the window
    transX = Math.round(xc - trigProps.left - trigProps.width / 2);
    transY = Math.round(yc - trigProps.top - trigProps.height / 2);

		// if the modal is aligned to the top then move the button to the center-y of the modal instead of the window
    if (m.classList.contains('modal--align-top')) {
      transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
    }


		// translate button to center of screen
		trig.style.transform = 'translate(' + transX + 'px, ' + transY + 'px)';
		trig.style.webkitTransform = 'translate(' + transX + 'px, ' + transY + 'px)';
		// expand temporary div to the same size as the modal
		div.style.transform = 'scale(' + scaleX + ',' + scaleY + ')';
		div.style.webkitTransform = 'scale(' + scaleX + ',' + scaleY + ')';


		window.setTimeout(function() {
			window.requestAnimationFrame(function() {
				open(m, div);
			});
		}, contentDelay);

  };

  var open = function(m, div) {

    if (!isOpen) {
      // select the content inside the modal
      var content = m.querySelector('.modal__content');
      // reveal the modal
      m.classList.add('modal--active');
      // reveal the modal content
      content.classList.add('modal__content--active');

      /**
       * when the modal content is finished transitioning, fadeout the temporary
       * expanding div so when the window resizes it isn't visible ( it doesn't
       * move with the window).
       */

      content.addEventListener('transitionend', hideDiv, false);

      isOpen = true;
    }

    function hideDiv() {
      // fadeout div so that it can't be seen when the window is resized
      div.style.opacity = '0';
      content.removeEventListener('transitionend', hideDiv, false);
    }
  };

  var close = function(event) {

		event.preventDefault();
    event.stopImmediatePropagation();

    var target = event.target;
    var div = document.getElementById('modal__temp');

    /**
     * make sure the modal__bg or modal__close was clicked, we don't want to be able to click
     * inside the modal and have it close.
     */

    if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {

      // make the hidden div visible again and remove the transforms so it scales back to its original size
      div.style.opacity = '1';
      div.removeAttribute('style');

			/**
			* iterate through the modals and modal contents and triggers to remove their active classes.
      * remove the inline css from the trigger to move it back into its original position.
			*/

			for (var i = 0; i < len; i++) {
				modals[i].classList.remove('modal--active');
				content[i].classList.remove('modal__content--active');
				trigger[i].style.transform = 'none';
        trigger[i].style.webkitTransform = 'none';
				trigger[i].classList.remove('modal__trigger--active');
			}

      // when the temporary div is opacity:1 again, we want to remove it from the dom
			div.addEventListener('transitionend', removeDiv, false);

      isOpen = false;

    }

    function removeDiv() {
      setTimeout(function() {
        window.requestAnimationFrame(function() {
          // remove the temp div from the dom with a slight delay so the animation looks good
          div.remove();
        });
      }, contentDelay - 50);
    }

  };

  var bindActions = function() {
    for (var i = 0; i < len; i++) {
      trigger[i].addEventListener('click', getId, false);
      closers[i].addEventListener('click', close, false);
      modalsbg[i].addEventListener('click', close, false);
    }
  };

  var init = function() {
    bindActions();
  };

  return {
    init: init
  };

}());

Modal.init();

function tipoPedido(tipopedido){	
	window.location = tipopedido;
}

function tipoFaturamento(tipofaturamento){	
	window.location = tipofaturamento;
}

function filtraVendedor(atual) {
  var x = document.getElementById("vendedores").value;
  window.location = atual+'?vendedor='+x  
}

function filtraCliente(atual) {
  var x = document.getElementById("clientes").value;
  window.location = atual+'?cliente='+x  
}

function DesabilitaLoad() { 
	var estilo = document.getElementsByClassName('load');
	estilo[0].style.visibility = "hidden";
}

function HabilitaLoad() { 
	var estilo = document.getElementsByClassName('load');
	estilo[0].style.visibility = "visible";
}

function EmitindoNFE(e) {
	var div = document.createElement('div');
	var img = document.createElement('img');
	//img.src = 'img/carregando.gif';
	div.innerHTML = "Emitindo NFe...<br />";
	div.style.cssText = 'position: fixed; top: 25%; left: 10%; z-index: 5000; width: 80%; text-align: center; background: #ECECEC; border: 1px solid #000; font-size:20pt;';	
	document.body.appendChild(div);
	return true;
}

function AtualizandoNFE(e) {
	var div = document.createElement('div');
	var img = document.createElement('img');
	//img.src = 'img/carregando.gif';
	div.innerHTML ="Atualizando NFE...<br />";
	div.style.cssText = 'position: fixed; top: 25%; left: 10%; z-index: 5000; width: 80%; text-align: center; background: #ECECEC; border: 1px solid #000; font-size:20pt;';	
	document.body.appendChild(div);
	return true;
}

function VerificaCampos() {
	if (document.getElementById("pagamento").value == '') {
		alert('NECESSÁRIO INFORMAR O TIPO DE PAGAMENTO.');
		document.getElementById("pagamento").focus();
		return;
	}
	
	if (document.getElementById("forma_pagamento").value == '') {
		alert('NECESSÁRIO INFORMAR O MEIO DE PAGAMENTO.');
		document.getElementById("forma_pagamento").focus();
		return;
	}
	
	if (document.getElementById("forma_venda").value == '') {
		alert('NECESSÁRIO INFORMAR A FORMA DE VENDA.');
		document.getElementById("forma_venda").focus();
		return;
	}
	
	if (document.getElementById("tipo_frete").value == '') {
		alert('NECESSÁRIO INFORMAR O TIPO DE FRETE.');
		document.getElementById("tipo_frete").focus();
		return;
	}
	
	if (document.getElementById("tipo_volume").value == '') {
		alert('NECESSÁRIO INFORMAR O TIPO DE VOLUME.');
		document.getElementById("tipo_volume").focus();
		return;
	}
	
	if (document.getElementById("pagamento").value == '1') {
		if (document.getElementById("vencimento").value == '') {
			alert('PARA PAGAMENTOS À PRAZO É NECESSÁRIO INFORMAR UMA DATA PARA O PRIMEIRO VENCIMENTO.');
			document.getElementById("vencimento").focus();
			return;
		}
		if (document.getElementById("qtd_parcelas").value == '') {
			alert('PARA PAGAMENTOS À PRAZO É NECESSÁRIO INFORMAR A QUANTIDADE DE PARCELAS.');
			document.getElementById("qtd_parcelas").focus();
			return;
		}	
	}
	
	if (document.getElementById("pagamento").value == '0') {
		if (document.getElementById("qtd_parcelas").value != '') {
			alert('PARA PAGAMENTOS À VISTA NÃO É NECESSÁRIO INFORMAR A QUANTIDADE DE PARCELAS.');
			document.getElementById("pagamento").focus();
			return;
		}	
	}
	var div = document.createElement('div');
	var img = document.createElement('img');
	//img.src = 'img/carregando.gif';
	div.innerHTML ="Emitindo NFE...<br />";
	div.style.cssText = 'position: fixed; top: 25%; left: 10%; z-index: 5000; width: 80%; text-align: center; background: #ECECEC; border: 1px solid #000; font-size:20pt;';	
	document.body.appendChild(div);
	document.getElementById("form_fat_pedido").submit();
}