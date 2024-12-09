CREATE TABLE usuarios (
    id INT(11) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE tarefas (
    id INT(11) NOT NULL,
    usuario INT(11) NOT NULL,
    descricao TEXT NOT NULL,
    setor VARCHAR(255) NOT NULL,
    prioridade VARCHAR(25) NOT NULL,
    data date NOT NULL,
    status VARCHAR(20) DEFAULT 'a fazer'
);

ALTER TABLE usuario 
    ADD PRIMARY KEY (id);

ALTER TABLE tarefas ADD PRIMARY KEY (id), ADD KEY (usuario);

ALTER TABLE tarefas MODIFY id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE usuarios MODIFY id INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tarefas ADD CONSTRAINT FOREIGN KEY (usuario) REFERENCES usuarios (id);