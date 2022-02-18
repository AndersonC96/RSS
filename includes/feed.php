<?php
    use \App\feed\tecmundo;// Usar a classe tecmundo
    $obfeed = new tecmundo();// Instanciar a classe tecmundo
    $lastupdate = date('d/m/Y à\s H:i:s', strtotime($obfeed->getLastUpdate()));// Converter a data para o formato brasileiro
    $items = '';// Armazena os itens do feed
    foreach($obfeed->getItems() as $item){// Percorrer os itens do feed
        $image = $item->enclosure->attributes()->url;// Armazena a URL da imagem
        $date = date('d/m/Y à\s H:i:s', strtotime($item->pubDate));// Converter a data para o formato brasileiro
        $dc = $item->children('http://purl.org/dc/elements/1.1/');// Armazena os dados do conteúdo
        $items .= '<div class="col">
                        <div class="card text-dark h-100">
                            <div class="card-body">
                                <h5 class="card-title">'.$item->title.'</h5>
                                <img src="'.$image.'" class="card-img-top" alt="'.$item->title.'">
                                <p class="card-text">'.$item->description.'</p>
                            </div>
                            <div class="card-footer">
                                <span class="badge bg-primary">'.$item->category.'</span>
                                <small class="text-muted">Publicado em '.$date.' por <b>'.$dc.'</b></small>
                            </div>
                        </div>
                    </div>';
    }
?>
<div class="text-center">
    <img src="<?=$obfeed->getLogo()?>" class="mb-3">
    <h1 class="m-0"><?=$obfeed->getTitle()?></h1>
    <p class="m-0"><?=$obfeed->getDescription()?></p>
    <p class="text-muted mb-4"><?=$lastupdate?></p>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4">
    <?=$items?>
</div>