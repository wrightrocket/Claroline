<?php

namespace Claroline\CoreBundle\Migrations\pdo_sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/08/09 09:18:09
 */
class Version20130809091808 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_resource_node (
                id INT IDENTITY NOT NULL, 
                license_id INT, 
                resource_type_id INT NOT NULL, 
                user_id INT NOT NULL, 
                icon_id INT, 
                parent_id INT, 
                workspace_id INT NOT NULL, 
                next_id INT, 
                previous_id INT, 
                creation_date DATETIME2(6) NOT NULL, 
                modification_date DATETIME2(6) NOT NULL, 
                name NVARCHAR(255) NOT NULL, 
                lvl INT, 
                path NVARCHAR(3000), 
                mime_type NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FF460F904B ON claro_resource_node (license_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FF98EC6B7B ON claro_resource_node (resource_type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FFA76ED395 ON claro_resource_node (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FF54B9D732 ON claro_resource_node (icon_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FF727ACA70 ON claro_resource_node (parent_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A76799FF82D40A1F ON claro_resource_node (workspace_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A76799FFAA23F6C8 ON claro_resource_node (next_id) 
            WHERE next_id IS NOT NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A76799FF2DE62210 ON claro_resource_node (previous_id) 
            WHERE previous_id IS NOT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF460F904B FOREIGN KEY (license_id) 
            REFERENCES claro_license (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF98EC6B7B FOREIGN KEY (resource_type_id) 
            REFERENCES claro_resource_type (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FFA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF54B9D732 FOREIGN KEY (icon_id) 
            REFERENCES claro_resource_icon (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF727ACA70 FOREIGN KEY (parent_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FFAA23F6C8 FOREIGN KEY (next_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            ADD CONSTRAINT FK_A76799FF2DE62210 FOREIGN KEY (previous_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            DROP CONSTRAINT FK_3848F483B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            ADD CONSTRAINT FK_3848F483B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            DROP CONSTRAINT FK_E4A67CACB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            ADD CONSTRAINT FK_E4A67CACB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_resource_activity 
            DROP CONSTRAINT FK_DCF37C7EB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_activity 
            ADD CONSTRAINT FK_DCF37C7EB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_file 
            DROP CONSTRAINT FK_EA81C80BB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_file 
            ADD CONSTRAINT FK_EA81C80BB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_link 
            DROP CONSTRAINT FK_50B267EAB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_link 
            ADD CONSTRAINT FK_50B267EAB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_directory 
            DROP CONSTRAINT FK_12EEC186B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_directory 
            ADD CONSTRAINT FK_12EEC186B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_resource_shortcut 
            DROP CONSTRAINT FK_5E7F4AB8B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_shortcut 
            ADD CONSTRAINT FK_5E7F4AB8B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_text 
            DROP CONSTRAINT FK_5D9559DCB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_text 
            ADD CONSTRAINT FK_5D9559DCB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_log 
            DROP CONSTRAINT FK_97FAB91FB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_log 
            ADD CONSTRAINT FK_97FAB91FB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE SET NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_resource_node 
            DROP CONSTRAINT FK_A76799FF727ACA70
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            DROP CONSTRAINT FK_A76799FFAA23F6C8
        ");
        $this->addSql("
            ALTER TABLE claro_resource_node 
            DROP CONSTRAINT FK_A76799FF2DE62210
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            DROP CONSTRAINT FK_3848F483B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            DROP CONSTRAINT FK_E4A67CACB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_activity 
            DROP CONSTRAINT FK_DCF37C7EB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_file 
            DROP CONSTRAINT FK_EA81C80BB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_link 
            DROP CONSTRAINT FK_50B267EAB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_directory 
            DROP CONSTRAINT FK_12EEC186B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_shortcut 
            DROP CONSTRAINT FK_5E7F4AB8B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_text 
            DROP CONSTRAINT FK_5D9559DCB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_log 
            DROP CONSTRAINT FK_97FAB91FB87FAB32
        ");
        $this->addSql("
            DROP TABLE claro_resource_node
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            DROP CONSTRAINT FK_E4A67CACB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            ADD CONSTRAINT FK_E4A67CACB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id)
        ");
        $this->addSql("
            ALTER TABLE claro_directory 
            DROP CONSTRAINT FK_12EEC186B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_directory 
            ADD CONSTRAINT FK_12EEC186B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id)
        ");
        $this->addSql("
            ALTER TABLE claro_file 
            DROP CONSTRAINT FK_EA81C80BB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_file 
            ADD CONSTRAINT FK_EA81C80BB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id)
        ");
        $this->addSql("
            ALTER TABLE claro_link 
            DROP CONSTRAINT FK_50B267EAB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_link 
            ADD CONSTRAINT FK_50B267EAB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id)
        ");
        $this->addSql("
            ALTER TABLE claro_log 
            DROP CONSTRAINT FK_97FAB91FB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_log 
            ADD CONSTRAINT FK_97FAB91FB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_resource_activity 
            DROP CONSTRAINT FK_DCF37C7EB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_activity 
            ADD CONSTRAINT FK_DCF37C7EB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            DROP CONSTRAINT FK_3848F483B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            ADD CONSTRAINT FK_3848F483B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_shortcut 
            DROP CONSTRAINT FK_5E7F4AB8B87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_resource_shortcut 
            ADD CONSTRAINT FK_5E7F4AB8B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_text 
            DROP CONSTRAINT FK_5D9559DCB87FAB32
        ");
        $this->addSql("
            ALTER TABLE claro_text 
            ADD CONSTRAINT FK_5D9559DCB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource (id)
        ");
    }
}