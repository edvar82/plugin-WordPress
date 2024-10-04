# Plugin: Cadastro de Receitas de Bolos

## Descrição
Este plugin permite o cadastro e exibição de receitas de bolos no WordPress, com funcionalidades como filtros por categorias de receitas, exibição de receitas relacionadas e custom fields para exibir detalhes adicionais como tempo de preparo e lista de ingredientes.

## Funcionalidades
- Criação de um post type personalizado chamado 'Receitas'
- Taxonomia personalizada 'Categoria de Receita' para organizar receitas
- Templates customizados para listar receitas e exibir uma receita individual
- Suporte a campos personalizados como tempo de preparo e ingredientes, utilizando o plugin ACF (Advanced Custom Fields)

## Requisitos
Para o correto funcionamento deste plugin, é necessário instalar os seguintes plugins:

- **Advanced Custom Fields (ACF)**: Utilizado para gerenciar os campos personalizados (como o tempo de preparo e ingredientes).

## Instalação
Existem duas maneiras de instalar o plugin:

### Método 1: Upload via FTP
1. Faça o upload da pasta do plugin 'receitas-bolos' para o diretório `wp-content/plugins/` do seu WordPress.
2. No painel administrativo do WordPress, vá até 'Plugins' e ative o plugin 'Receitas de Bolos'.
3. Instale e ative o plugin [Advanced Custom Fields (ACF)](https://wordpress.org/plugins/advanced-custom-fields/).
4. Configure os campos personalizados (tempo de preparo, ingredientes, etc.) utilizando o ACF. O plugin já está configurado para exibir esses campos nas páginas de receita.

### Método 2: Upload pelo Dashboard
1. No painel administrativo do WordPress, vá até 'Plugins' > 'Adicionar Novo'.
2. Clique em 'Fazer upload de plugin' e escolha o arquivo ZIP do plugin.
3. Clique em 'Instalar agora' e, após a instalação, ative o plugin.
4. Instale e ative o plugin [Advanced Custom Fields (ACF)](https://wordpress.org/plugins/advanced-custom-fields/).
5. Configure os campos personalizados (tempo de preparo, ingredientes, etc.) utilizando o ACF.

## Templates Customizados
Este plugin utiliza dois templates customizados para exibição das receitas:

- `archive-receita.php`: Exibe a lista de todas as receitas, categorizadas conforme a taxonomia 'Categoria de Receita'.
- `single-receita.php`: Exibe uma única receita, com detalhes como tempo de preparo, ingredientes e receitas relacionadas.
