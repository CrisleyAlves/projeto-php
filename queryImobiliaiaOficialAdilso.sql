create table tbl_tipos(
tip_codigo serial not null,
tip_nome varchar(100) not null,
primary key(tip_codigo));

create table tbl_cidades(
cid_codigo serial not null,
cid_nome varchar(100) not null,
cid_uf char(2) not null,
primary key(codigo));

create table tbl_proprietarios(
pro_codigo serial not null,
pro_nome varchar(100) not null,
pro_cpf varchar(15) not null,
pro_rg varchar(15) not null,
pro_email varchar(100) not null,
pro_contato varchar(100) not null,
primary key(pro_codigo));

create table tbl_bairros(
bai_codigo serial not null,
bai_nome varchar(100) not null,
cod_cidade integer not null,
primary key(bai_codigo),
foreign key(cod_cidade) references tbl_cidades(cid_codigo));

create table tbl_operacoes(
ope_codigo serial not null,
ope_nome varchar(100) not null,
primary key(ope_codigo));

create table tbl_imoveis(
imo_codigo serial not null,
imo_endereco varchar(200) not null,
imo_quartos integer not null,
imo_valor numeric(10,2) not null,
imo_condominio numeric(10,2) not null,
pro_codigo integer not null,
tip_codigo integer not null,
ope_codigo integer not null,
bai_codigo integer not null,
primary key(imo_codigo), 
foreign key(pro_codigo) references tbl_proprietarios(pro_codigo),
foreign key(tip_codigo) references tbl_tipos(tip_codigo),
foreign key(ope_codigo) references tbl_operacoes(ope_codigo),
foreign key(bai_codigo) references tbl_bairros(bai_codigo));


create table tbl_fotos(
fot_codigo serial not null,
imo_codigo integer not null,
fot_nome varchar(100) not null,
primary key(fot_codigo), 
foreign key(imo_codigo) references tbl_imoveis(imo_codigo));

create table tbl_solicitacoes(
sol_codigo serial not null,
sol_nome varchar(100) not null,
sol_assunto varchar(100) not null,
sol_imovel integer not null,
sol_contato varchar(20) not null,
sol_email varchar(100) not null,
sol_mensagem text not null,
sol_status char(1) not null,
primary key(sol_codigo), 
foreign key(sol_imovel) references tbl_imoveis(imo_codigo));

create table tbl_administradores(
adm_codigo serial not null,
adm_nome varchar(100) not null,
adm_login varchar(50) not null,
adm_senha varchar(50) not null,
primary key(adm_codigo));