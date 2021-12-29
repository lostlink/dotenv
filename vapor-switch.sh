#!/usr/bin/env bash

validate_input() {
  # Check if vapor.yml exists
  if [[ -f "${VAPORFILE}" && ${FORCE} == "false" ]];
  then
    echo "${FORCE} ${VAPORFILE} exist, we are not allowed to run the vapor script"
    exit
  fi

  # OS should be alpine or debian only
  if [[ ${REGION} != "us-east-1" && ${REGION} != "us-west-2" ]];
  then
    echo "Missing AWS Region, eg: '--region us-east-1'" ; exit 1
  fi
}

default_input() {
  VAPORFILE="${VAPORFILE:-vapor.yml}"
  FORCE="${FORCE:-false}"
}

main() {
  while [[ "$#" -gt 0 ]]
  do
    case $1 in
      -r|--region)
        local REGION="$2"
        shift
        ;;
      -vf|--vapor_file)
        local VAPORFILE="$2"
        ;;
      -f|--force)
        local FORCE=true
        ;;
    esac
    shift
  done

  default_input

  validate_input

  ENVIROMENTFILE="vapor-${REGION}.yml"

  cp "${ENVIROMENTFILE}" "${VAPORFILE}"
}

help () {
cat << EOD
  TODO: Write a nice Help output
EOD
}

if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
  if [ $# -eq 0 ]; then
      help
      exit 1
  fi

    main "$@"
fi