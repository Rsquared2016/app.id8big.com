#!/bin/bash
echo "UPDATE $5datalists"
echo "	SET value =  '$2'"
echo "	WHERE $5datalists.name = 'path';"
echo "" 
echo "UPDATE $5datalists"
echo "	SET value = '$3'"
echo "	WHERE $5datalists.name = 'dataroot';"
echo "" 
echo "UPDATE $5sites_entity"
echo "	SET url = '$4'",
echo "  name = '$1'"
echo "	WHERE $5sites_entity.guid=1;"
